<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\TipoCampanha;
use Illuminate\Http\Request;

class CampCateController extends Controller
{
    public function index(Request $request)
    {
        $searchCategoria = $request->input('search_categoria');
        $searchCampanha = $request->input('search_campanha');
        $tab = $request->input('tab');

        $categorias = Categoria::query()
            ->when($searchCategoria, function($query, $search) {
                return $query->where('nome', 'like', '%' . $search . '%');
            })
            ->orderBy('nome')
            ->paginate(10)
            ->appends([
                'search_categoria' => $searchCategoria,
                'tab' => $tab
            ]);

        $tipoCampanhas = TipoCampanha::query()
            ->when($searchCampanha, function($query, $search) {
                return $query->where('nome', 'like', '%' . $search . '%');
            })
            ->orderBy('nome')
            ->paginate(10)
            ->appends([
                'search_campanha' => $searchCampanha,
                'tab' => $tab
            ]);

        return view('admin.pages.campanhas-categorias', compact('categorias', 'tipoCampanhas'));
    }

    public function storeCategoria(Request $request)
    {
        $request->validate([
            'nome_categoria' => 'required|string|max:255',
        ]);

        Categoria::create(['nome' => $request->nome_categoria]);

        return redirect()->route('admin.cadastros.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function updateCategoria(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update(['nome' => $request->nome]);

        return redirect()->route('admin.cadastros.index', ['tab' => 'categorias'])
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function storeTipoCampanha(Request $request)
    {
        $request->validate([
            'nome_tipo_campanha' => 'required|string|max:255',
            'meta' => 'nullable|numeric|min:0',
        ]);

        TipoCampanha::create([
            'nome' => $request->nome_tipo_campanha,
            'meta' => $request->meta,
        ]);

        return redirect()->route('admin.cadastros.index')
            ->with('success', 'Tipo de campanha criado com sucesso!');
    }

    public function updateTipoCampanha(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'meta' => 'nullable|numeric|min:0',
        ]);

        $tipoCampanha = TipoCampanha::findOrFail($id);
        $tipoCampanha->update([
            'nome' => $request->nome,
            'meta' => $request->meta,
        ]);

        return redirect()->route('admin.cadastros.index', ['tab' => 'campanhas'])
            ->with('success', 'Campanha atualizada com sucesso!');
    }

    public function destroyCategoria(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.cadastros.index', ['tab' => 'categorias'])
            ->with('success', 'Categoria excluída com sucesso!');
    }

    public function destroyTipoCampanha(string $id)
    {
        $tipoCampanha = TipoCampanha::findOrFail($id);
        $tipoCampanha->delete();

        return redirect()->route('admin.cadastros.index', ['tab' => 'campanhas'])
            ->with('success', 'Tipo de campanha excluído com sucesso!');
    }
}
