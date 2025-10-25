<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\TipoCampanha;
use Illuminate\Http\Request;

class CampCateController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->get();
        $tipoCampanhas = TipoCampanha::orderBy('nome')->get();

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

    public function storeTipoCampanha(Request $request)
    {
        $request->validate([
            'nome_tipo_campanha' => 'required|string|max:255',
        ]);

        TipoCampanha::create(['nome' => $request->nome_tipo_campanha]);

        return redirect()->route('admin.cadastros.index')
            ->with('success', 'Tipo de campanha criado com sucesso!');
    }

    public function destroyCategoria(string $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('admin.cadastros.index')
            ->with('success', 'Categoria excluída com sucesso!');
    }

    public function destroyTipoCampanha(string $id)
    {
        $tipoCampanha = TipoCampanha::findOrFail($id);
        $tipoCampanha->delete();

        return redirect()->route('admin.cadastros.index')
            ->with('success', 'Tipo de campanha excluído com sucesso!');
    }
}
