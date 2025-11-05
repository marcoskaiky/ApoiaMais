<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        $user = Auth::user();

        // Verificar se o usuário está atualizando seu próprio perfil
        if ($user->id != $id) {
            abort(403, 'Não autorizado');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Registrar na auditoria
        Auditoria::registrar(
            'Edição de Perfil',
            "Atualizou seu perfil (Nome: {$request->name})"
        );

        return redirect()->route('admin.profile.index')->with('success', 'Perfil atualizado com sucesso!');
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Registrar na auditoria
        Auditoria::registrar(
            'Alteração de Senha',
            'Alterou sua senha'
        );

        return redirect()->route('admin.profile.index')->with('success', 'Senha alterada com sucesso!');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
