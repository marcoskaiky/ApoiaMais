<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use App\Models\Item;
use App\Models\TipoCampanha;
use App\Models\EnviarDoacao;
use App\Models\EnviarDoacaoItem;
use App\Models\ReceberDoacaoItem;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnviarDoacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab');

        // Listar doações enviadas (histórico) e também carregar dados para o formulário
        $doacoes = EnviarDoacao::with(['instituicao', 'itens.item', 'campanha'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $doacoes->appends(['tab' => $tab]);

        $instituicoes = Instituicao::orderBy('nome')->get();
        $campanhas = TipoCampanha::orderBy('nome')->get();

        // Buscar itens disponíveis no estoque (apenas os que têm quantidade > 0)
        $itensDisponiveis = $this->getItensDisponiveis();

        return view('admin.pages.enviar-doacao', compact(
            'doacoes',
            'instituicoes',
            'campanhas',
            'itensDisponiveis'
        ));
    }

    /**
     * Obter itens disponíveis no estoque
     */
    private function getItensDisponiveis()
    {
        // Buscar todos os itens recebidos
        $itensRecebidos = ReceberDoacaoItem::with(['item.categoria'])->get();

        // Buscar todos os itens enviados
        $itensEnviados = EnviarDoacaoItem::all();

        // Agrupar itens recebidos por características
        $itensAgrupadosRecebidos = $itensRecebidos->groupBy(function ($itemDoacao) {
            return $this->gerarChaveAgrupamento($itemDoacao);
        })->map(function ($grupo) {
            $primeiro = $grupo->first();
            return [
                'item' => $primeiro->item,
                'quantidade_total' => $grupo->sum('quantidade'),
                'validade' => $primeiro->validade,
                'condicao' => $primeiro->condicao,
                'tamanho_valor' => $primeiro->tamanho_valor,
                'tamanho_unidade' => $primeiro->tamanho_unidade,
                'tamanho_texto' => $primeiro->tamanho_texto,
            ];
        });

        // Agrupar itens enviados por características
        $itensAgrupadosEnviados = $itensEnviados->groupBy(function ($itemDoacao) {
            return $this->gerarChaveAgrupamento($itemDoacao);
        })->map(function ($grupo) {
            return $grupo->sum('quantidade');
        });

        // Calcular estoque disponível
        $itensDisponiveis = collect();
        foreach ($itensAgrupadosRecebidos as $chave => $itemAgrupado) {
            $quantidadeRecebida = $itemAgrupado['quantidade_total'];
            $quantidadeEnviada = $itensAgrupadosEnviados->get($chave, 0);
            $quantidadeDisponivel = $quantidadeRecebida - $quantidadeEnviada;

            if ($quantidadeDisponivel > 0) {
                $itensDisponiveis->push([
                    'id' => $itemAgrupado['item']->id,
                    'nome' => $itemAgrupado['item']->nome,
                    'categoria' => $itemAgrupado['item']->categoria->nome ?? 'Sem categoria',
                    'quantidade_disponivel' => $quantidadeDisponivel,
                    'validade' => $itemAgrupado['validade'],
                    'condicao' => $itemAgrupado['condicao'],
                    'tamanho_valor' => $itemAgrupado['tamanho_valor'],
                    'tamanho_unidade' => $itemAgrupado['tamanho_unidade'],
                    'tamanho_texto' => $itemAgrupado['tamanho_texto'],
                    'possui_validade' => (bool) $itemAgrupado['item']->validade,
                    'possui_condicao' => (bool) $itemAgrupado['item']->condicao,
                    'possui_tamanho' => (bool) $itemAgrupado['item']->tamanho,
                ]);
            }
        }

        return $itensDisponiveis;
    }

    /**
     * Gerar chave de agrupamento para itens
     */
    private function gerarChaveAgrupamento($itemDoacao)
    {
        $chave = 'item_' . $itemDoacao->item_id;
        $chave .= '|validade_' . ($itemDoacao->validade ? $itemDoacao->validade->format('Y-m-d') : 'null');
        $chave .= '|condicao_' . ($itemDoacao->condicao ?? 'null');
        if ($itemDoacao->tamanho_valor && $itemDoacao->tamanho_unidade) {
            $chave .= '|tamanho_' . number_format($itemDoacao->tamanho_valor, 2, '.', '') . '_' . trim($itemDoacao->tamanho_unidade);
        } elseif ($itemDoacao->tamanho_texto) {
            $chave .= '|tamanho_' . trim($itemDoacao->tamanho_texto);
        } else {
            $chave .= '|tamanho_null';
        }
        return $chave;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'instituicao_id' => 'required|exists:instituicaos,id',
            'campanha_id' => 'nullable|exists:tipo_campanhas,id',
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.item_id' => 'required|exists:items,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Validar se há estoque suficiente para cada item
            foreach ($request->input('itens') as $itemData) {
                $quantidadeDisponivel = $this->verificarEstoqueDisponivel(
                    $itemData['item_id'],
                    $itemData['validade'] ?? null,
                    $itemData['condicao'] ?? null,
                    $itemData['tamanho_valor'] ?? null,
                    $itemData['tamanho_unidade'] ?? null,
                    $itemData['tamanho_texto'] ?? null
                );

                if ($quantidadeDisponivel < $itemData['quantidade']) {
                    $item = Item::find($itemData['item_id']);
                    DB::rollBack();
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Estoque insuficiente para o item '{$item->nome}'. Disponível: {$quantidadeDisponivel}, Solicitado: {$itemData['quantidade']}");
                }
            }

            // Criar o envio de doação
            $doacao = EnviarDoacao::create([
                'instituicao_id' => $request->instituicao_id,
                'campanha_id' => $request->campanha_id,
                'observacoes' => $request->observacoes,
            ]);

            // Salvar itens
            foreach ($request->input('itens') as $itemData) {
                $itemPayload = [
                    'enviar_doacao_id' => $doacao->id,
                    'item_id' => $itemData['item_id'],
                    'quantidade' => $itemData['quantidade'],
                    'validade' => $itemData['validade'] ?? null,
                    'tamanho_valor' => $itemData['tamanho_valor'] ?? null,
                    'tamanho_unidade' => $itemData['tamanho_unidade'] ?? null,
                    'tamanho_texto' => isset($itemData['tamanho_texto']) ? strtoupper($itemData['tamanho_texto']) : null,
                    'condicao' => $itemData['condicao'] ?? null,
                ];

                EnviarDoacaoItem::create($itemPayload);
            }

            // Registrar na auditoria
            $instituicao = Instituicao::find($request->instituicao_id);
            $totalItens = collect($request->input('itens'))->sum('quantidade');
            Auditoria::registrar(
                'Saída de Item',
                "Enviou {$totalItens} itens para a instituição '{$instituicao->nome}'"
            );

            DB::commit();

            return redirect()->route('admin.enviar-doacaos.index', ['tab' => 'historico'])
                ->with('success', 'Doação enviada com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao enviar doação: ' . $e->getMessage());
        }
    }

    /**
     * Verificar estoque disponível para um item específico
     */
    private function verificarEstoqueDisponivel($itemId, $validade, $condicao, $tamanhoValor, $tamanhoUnidade, $tamanhoTexto)
    {
        // Buscar quantidade recebida
        $recebidos = ReceberDoacaoItem::where('item_id', $itemId)
            ->when($validade, function ($query, $validade) {
                return $query->where('validade', $validade);
            }, function ($query) {
                return $query->whereNull('validade');
            })
            ->when($condicao, function ($query, $condicao) {
                return $query->where('condicao', $condicao);
            }, function ($query) {
                return $query->whereNull('condicao');
            })
            ->when($tamanhoValor && $tamanhoUnidade, function ($query) use ($tamanhoValor, $tamanhoUnidade) {
                return $query->where('tamanho_valor', $tamanhoValor)
                    ->where('tamanho_unidade', $tamanhoUnidade);
            })
            ->when($tamanhoTexto, function ($query, $tamanhoTexto) {
                return $query->where('tamanho_texto', strtoupper($tamanhoTexto));
            })
            ->sum('quantidade');

        // Buscar quantidade já enviada
        $enviados = EnviarDoacaoItem::where('item_id', $itemId)
            ->when($validade, function ($query, $validade) {
                return $query->where('validade', $validade);
            }, function ($query) {
                return $query->whereNull('validade');
            })
            ->when($condicao, function ($query, $condicao) {
                return $query->where('condicao', $condicao);
            }, function ($query) {
                return $query->whereNull('condicao');
            })
            ->when($tamanhoValor && $tamanhoUnidade, function ($query) use ($tamanhoValor, $tamanhoUnidade) {
                return $query->where('tamanho_valor', $tamanhoValor)
                    ->where('tamanho_unidade', $tamanhoUnidade);
            })
            ->when($tamanhoTexto, function ($query, $tamanhoTexto) {
                return $query->where('tamanho_texto', strtoupper($tamanhoTexto));
            })
            ->sum('quantidade');

        return $recebidos - $enviados;
    }

    /**
     * Display the specified resource.
     */
    public function show(EnviarDoacao $enviarDoacao)
    {
        $enviarDoacao->load('itens.item.categoria', 'instituicao', 'campanha');
        return view('admin.pages.enviar-doacao-show', compact('enviarDoacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnviarDoacao $enviarDoacao)
    {
        $request->validate([
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.id' => 'required|exists:enviar_doacao_items,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens_excluir' => 'nullable|array',
            'itens_excluir.*' => 'exists:enviar_doacao_items,id',
        ]);

        DB::beginTransaction();
        try {
            // Atualizar observações
            $enviarDoacao->update([
                'observacoes' => $request->observacoes,
            ]);

            // Excluir itens marcados para exclusão
            if ($request->has('itens_excluir')) {
                foreach ($request->input('itens_excluir') as $itemId) {
                    $item = EnviarDoacaoItem::find($itemId);
                    if ($item && $item->enviar_doacao_id == $enviarDoacao->id) {
                        $item->delete();
                    }
                }
            }

            // Atualizar itens
            foreach ($request->input('itens') as $itemData) {
                $item = EnviarDoacaoItem::find($itemData['id']);
                if ($item && $item->enviar_doacao_id == $enviarDoacao->id) {
                    // Verificar se há estoque suficiente para a nova quantidade
                    $diferencaQuantidade = $itemData['quantidade'] - $item->quantidade;

                    if ($diferencaQuantidade > 0) {
                        $quantidadeDisponivel = $this->verificarEstoqueDisponivel(
                            $item->item_id,
                            $item->validade,
                            $item->condicao,
                            $item->tamanho_valor,
                            $item->tamanho_unidade,
                            $item->tamanho_texto
                        );

                        // Adicionar a quantidade atual do item ao estoque disponível
                        $quantidadeDisponivel += $item->quantidade;

                        if ($quantidadeDisponivel < $itemData['quantidade']) {
                            $itemNome = $item->item->nome;
                            DB::rollBack();
                            return redirect()->back()
                                ->with('error', "Estoque insuficiente para o item '{$itemNome}'. Disponível: {$quantidadeDisponivel}, Solicitado: {$itemData['quantidade']}");
                        }
                    }

                    $item->update([
                        'quantidade' => $itemData['quantidade'],
                        'validade' => $itemData['validade'] ?? null,
                        'tamanho_valor' => $itemData['tamanho_valor'] ?? null,
                        'tamanho_unidade' => $itemData['tamanho_unidade'] ?? null,
                        'tamanho_texto' => isset($itemData['tamanho_texto']) ? strtoupper($itemData['tamanho_texto']) : null,
                        'condicao' => $itemData['condicao'] ?? null,
                    ]);
                }
            }

            // Registrar na auditoria
            Auditoria::registrar(
                'Edição de Envio',
                "Editou o envio de doação ID {$enviarDoacao->id}"
            );

            DB::commit();

            return redirect()->route('admin.enviar-doacaos.index', ['tab' => 'historico'])
                ->with('success', 'Envio atualizado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Erro ao atualizar envio: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnviarDoacao $enviarDoacao)
    {
        $doacaoId = $enviarDoacao->id;
        $enviarDoacao->delete();

        // Registrar na auditoria
        Auditoria::registrar(
            'Exclusão de Envio',
            "Excluiu o envio de doação ID {$doacaoId}"
        );

        return redirect()->route('admin.enviar-doacaos.index', ['tab' => 'historico'])
            ->with('success', 'Envio removido com sucesso.');
    }
}
