<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $searchItem = $request->input('search_item');
        $tab = $request->input('tab');

        $itens = Item::with('categoria')
            ->when($searchItem, function($query, $search) {
                return $query->where('nome', 'like', '%' . $search . '%')
                    ->orWhereHas('categoria', function($q) use ($search) {
                        $q->where('nome', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('nome')
            ->paginate(10)
            ->appends([
                'search_item' => $searchItem,
                'tab' => $tab
            ]);

        return view('admin.pages.item', compact('categorias', 'itens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'estoque_minimo' => 'required|integer|min:0',
            'validade' => 'nullable|boolean',
            'condicao' => 'nullable|boolean',
            'tamanho' => 'nullable|boolean',
        ]);

        // Converter checkboxes para boolean
        $validated['validade'] = $request->has('validade') ? true : false;
        $validated['condicao'] = $request->has('condicao') ? true : false;
        $validated['tamanho'] = $request->has('tamanho') ? true : false;

        Item::create($validated);

        return redirect()->route('admin.item.index')
            ->with('success', 'Item cadastrado com sucesso!');
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
        $item = Item::with('categoria')->findOrFail($id);
        $categorias = Categoria::orderBy('nome')->get();
        return view('admin.pages.item-edit', compact('item', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'estoque_minimo' => 'required|integer|min:0',
            'validade' => 'nullable|boolean',
            'condicao' => 'nullable|boolean',
            'tamanho' => 'nullable|boolean',
        ]);

        // Converter checkboxes para boolean
        $validated['validade'] = $request->has('validade') ? true : false;
        $validated['condicao'] = $request->has('condicao') ? true : false;
        $validated['tamanho'] = $request->has('tamanho') ? true : false;

        $item->update($validated);

        return redirect()->route('admin.item.index', ['tab' => 'lista'])
            ->with('success', 'Item atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.item.index', ['tab' => 'lista'])
            ->with('success', 'Item excluído com sucesso!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}
