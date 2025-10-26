<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doador;
use Illuminate\Http\Request;

class DoadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.doador');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_doador' => 'required|in:PF,PJ',
            'nome_doador' => 'required|string|max:255',
            'cpf_doador' => 'nullable|string|size:14|unique:doadors,cpf',
            'cnpj_doador' => 'nullable|string|size:18|unique:doadors,cnpj',
            'telefone_doador' => 'required|string|max:15',
            'cep_doador' => 'required|string|size:9',
            'rua_doador' => 'required|string|max:255',
            'numero_doador' => 'required|string|max:10',
            'bairro_doador' => 'required|string|max:100',
            'cidade_doador' => 'required|string|max:100',
            'uf_doador' => 'required|string|max:2',
            'complemento_doador' => 'nullable|string|max:255',
        ]);

        Doador::create([
            'tipo' => $validated['tipo_doador'],
            'nome' => $validated['nome_doador'],
            'cpf' => $validated['cpf_doador'] ?? null,
            'cnpj' => $validated['cnpj_doador'] ?? null,
            'telefone' => $validated['telefone_doador'],
            'cep' => $validated['cep_doador'],
            'rua' => $validated['rua_doador'],
            'numero' => $validated['numero_doador'],
            'bairro' => $validated['bairro_doador'],
            'cidade' => $validated['cidade_doador'],
            'uf' => $validated['uf_doador'],
            'complemento' => $validated['complemento_doador'] ?? null,
        ]);

        return redirect()->route('admin.doadores.index')
            ->with('success', 'Doador cadastrado com sucesso!');
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
