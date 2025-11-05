<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auditoria::with('usuario');

        // Filtro de busca
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('usuario', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhere('tipo_acao', 'like', "%{$search}%")
                    ->orWhere('detalhes', 'like', "%{$search}%")
                    ->orWhere('data_hora', 'like', "%{$search}%");
            });
        }

        // Filtro de tipo de ação
        if ($request->has('tipo_acao') && $request->tipo_acao != '') {
            $query->where('tipo_acao', $request->tipo_acao);
        }

        // Filtro de data inicial
        if ($request->has('data_inicial') && $request->data_inicial != '') {
            $query->whereDate('data_hora', '>=', $request->data_inicial);
        }

        // Filtro de data final
        if ($request->has('data_final') && $request->data_final != '') {
            $query->whereDate('data_hora', '<=', $request->data_final);
        }

        // Ordenar por data mais recente
        $auditorias = $query->orderBy('data_hora', 'desc')->paginate(15);

        return view('admin.pages.auditoria', compact('auditorias'));
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
