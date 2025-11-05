<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doador;
use App\Models\Item;
use App\Models\TipoCampanha;
use App\Models\ReceberDoacao;
use App\Models\ReceberDoacaoItem;
use App\Models\Auditoria;
use Illuminate\Http\Request;

class ReceberDoacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab');

        // Listar doações (histórico) e também carregar dados para o formulário
        $doacoes = ReceberDoacao::with(['doador', 'itens.item', 'campanha'])->orderBy('created_at', 'desc')->paginate(10);
        $doacoes->appends(['tab' => $tab]);

        $doadores = Doador::orderBy('nome')->get();
        $itens = Item::with('categoria')->orderBy('nome')->get();
        $campanhas = TipoCampanha::orderBy('nome')->get();

        // Formatar itens para JavaScript
        $itensFormatados = $itens->map(function ($item) {
            return [
                'id' => $item->id,
                'nome' => $item->nome,
                'categoria' => $item->categoria->nome ?? 'Sem categoria',
                'validade' => (bool) $item->validade,
                'condicao' => (bool) $item->condicao,
                'tamanho' => (bool) $item->tamanho
            ];
        });

        return view('admin.pages.receber-doacao', compact('doacoes', 'doadores', 'itens', 'campanhas', 'itensFormatados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doadores = Doador::orderBy('nome')->get();
        $itens = Item::with('categoria')->orderBy('nome')->get();
        $campanhas = TipoCampanha::orderBy('nome')->get();

        return view('admin.pages.receber-doacao', compact('doadores', 'itens', 'campanhas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doador_id' => 'required|exists:doadors,id',
            'campanha_id' => 'nullable|exists:tipo_campanhas,id',
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.item_id' => 'required|exists:items,id',
            'itens.*.quantidade' => 'required|integer|min:1',
        ]);

        // Criar a doação
        $doacao = ReceberDoacao::create([
            'doador_id' => $request->doador_id,
            'campanha_id' => $request->campanha_id,
            'observacoes' => $request->observacoes,
        ]);

        // Salvar itens
        foreach ($request->input('itens') as $itemData) {
            // form validation adicional por item
            $itemPayload = [
                'receber_doacao_id' => $doacao->id,
                'item_id' => $itemData['item_id'],
                'quantidade' => $itemData['quantidade'],
                'validade' => $itemData['validade'] ?? null,
                'tamanho_valor' => $itemData['tamanho_valor'] ?? null,
                'tamanho_unidade' => $itemData['tamanho_unidade'] ?? null,
                'tamanho_texto' => isset($itemData['tamanho_texto']) ? strtoupper($itemData['tamanho_texto']) : null,
                'condicao' => $itemData['condicao'] ?? null,
            ];

            ReceberDoacaoItem::create($itemPayload);
        }

        // Registrar na auditoria
        $doador = Doador::find($request->doador_id);
        $totalItens = collect($request->input('itens'))->sum('quantidade');
        Auditoria::registrar(
            'Entrada de Item',
            "Registrou doação de {$totalItens} itens do doador '{$doador->nome}'"
        );

        return redirect()->route('admin.receber-doacaos.index', ['tab' => 'historico'])->with('success', 'Doação registrada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReceberDoacao $receberDoacao)
    {
        $receberDoacao->load('itens.item.categoria', 'doador', 'campanha');
        return view('admin.pages.receber-doacao-show', compact('receberDoacao'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReceberDoacao $receberDoacao)
    {
        $request->validate([
            'observacoes' => 'nullable|string',
            'itens' => 'required|array|min:1',
            'itens.*.id' => 'required|exists:receber_doacao_items,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens_excluir' => 'nullable|array',
            'itens_excluir.*' => 'exists:receber_doacao_items,id',
        ]);

        // Atualizar observações
        $receberDoacao->update([
            'observacoes' => $request->observacoes,
        ]);

        // Excluir itens marcados para exclusão
        if ($request->has('itens_excluir')) {
            foreach ($request->input('itens_excluir') as $itemId) {
                $item = ReceberDoacaoItem::find($itemId);
                if ($item && $item->receber_doacao_id == $receberDoacao->id) {
                    $item->delete();
                }
            }
        }

        // Atualizar itens
        foreach ($request->input('itens') as $itemData) {
            $item = ReceberDoacaoItem::find($itemData['id']);
            if ($item && $item->receber_doacao_id == $receberDoacao->id) {
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
            'Edição de Doação',
            "Editou a doação ID {$receberDoacao->id}"
        );

        return redirect()->route('admin.receber-doacaos.index', ['tab' => 'historico'])
            ->with('success', 'Doação atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReceberDoacao $receberDoacao)
    {
        $doacaoId = $receberDoacao->id;
        $receberDoacao->delete();

        // Registrar na auditoria
        Auditoria::registrar(
            'Exclusão de Doação',
            "Excluiu a doação ID {$doacaoId}"
        );

        return redirect()->route('admin.receber-doacaos.index', ['tab' => 'historico'])->with('success', 'Doação removida.');
    }
}
