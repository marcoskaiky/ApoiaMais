<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ReceberDoacaoItem;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Busca e paginação dos itens
        $todosItensQuery = Item::with('categoria')->orderBy('nome');
        if ($search) {
            $todosItensQuery->where(function($q) use ($search) {
                $q->where('nome', 'like', "%$search%")
                  ->orWhereHas('categoria', function($qc) use ($search) {
                      $qc->where('nome', 'like', "%$search%");
                  });
            });
        }
        $todosItens = $todosItensQuery->paginate(15)->appends(['search' => $search]);

        // Buscar todos os itens recebidos
        $itensRecebidos = ReceberDoacaoItem::with(['item.categoria', 'doacao.doador', 'doacao.campanha'])->get();

        // Agrupar itens recebidos por características
        $itensAgrupadosRecebidos = $itensRecebidos->groupBy(function($itemDoacao) {
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
        })->map(function($grupo) {
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

        // Montar lista paginada
        $itensCompletos = collect();
        foreach ($todosItens as $item) {
            $doacoesDoItem = $itensAgrupadosRecebidos->filter(function($itemAgrupado) use ($item) {
                return $itemAgrupado['item']->id === $item->id;
            });
            if ($doacoesDoItem->isEmpty()) {
                $itensCompletos->push([
                    'item' => $item,
                    'quantidade_total' => 0,
                    'validade' => null,
                    'condicao' => null,
                    'tamanho_valor' => null,
                    'tamanho_unidade' => null,
                    'tamanho_texto' => null,
                    'porcentagem' => 0,
                    'cor_barra' => 'danger',
                ]);
            } else {
                foreach ($doacoesDoItem as $itemAgrupado) {
                    $quantidade = $itemAgrupado['quantidade_total'];
                    $estoqueMinimo = $item->estoque_minimo;
                    if ($estoqueMinimo > 0) {
                        $porcentagem = ($quantidade / $estoqueMinimo) * 100;
                    } else {
                        $porcentagem = 100;
                    }
                    if ($porcentagem < 100) {
                        $corBarra = 'danger';
                    } elseif ($porcentagem >= 100 && $porcentagem < 151) {
                        $corBarra = 'warning';
                    } else {
                        $corBarra = 'success';
                    }
                    $itensCompletos->push([
                        'item' => $itemAgrupado['item'],
                        'quantidade_total' => $quantidade,
                        'validade' => $itemAgrupado['validade'],
                        'condicao' => $itemAgrupado['condicao'],
                        'tamanho_valor' => $itemAgrupado['tamanho_valor'],
                        'tamanho_unidade' => $itemAgrupado['tamanho_unidade'],
                        'tamanho_texto' => $itemAgrupado['tamanho_texto'],
                        'porcentagem' => round($porcentagem, 1),
                        'cor_barra' => $corBarra,
                    ]);
                }
            }
        }
        $itensAgrupados = $itensCompletos;

        return view('admin.pages.listaEstoque', compact('itensAgrupados', 'todosItens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
