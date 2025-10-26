<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_instituicao' => 'required|string|max:255',
            'cnpj_instituicao' => 'required|string|size:18|unique:instituicaos,cnpj',
            'telefone_instituicao' => 'required|string|max:15',
            'cep_instituicao' => 'required|string|size:9',
            'rua_instituicao' => 'required|string|max:255',
            'numero_instituicao' => 'required|string|max:10',
            'bairro_instituicao' => 'required|string|max:100',
            'cidade_instituicao' => 'required|string|max:100',
            'uf_instituicao' => 'required|string|max:2',
            'complemento_instituicao' => 'nullable|string|max:255',
        ]);

        Instituicao::create([
            'nome' => $validated['nome_instituicao'],
            'cnpj' => $validated['cnpj_instituicao'],
            'telefone' => $validated['telefone_instituicao'],
            'cep' => $validated['cep_instituicao'],
            'rua' => $validated['rua_instituicao'],
            'numero' => $validated['numero_instituicao'],
            'bairro' => $validated['bairro_instituicao'],
            'cidade' => $validated['cidade_instituicao'],
            'uf' => $validated['uf_instituicao'],
            'complemento' => $validated['complemento_instituicao'] ?? null,
        ]);

        return redirect()->route('admin.doadores.index')
            ->with('success', 'Instituição cadastrada com sucesso!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
