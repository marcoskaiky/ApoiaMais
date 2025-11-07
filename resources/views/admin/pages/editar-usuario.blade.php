@extends('admin.dashboard')

@section('content')
@vite('resources/css/usuarios.css')

<div class="content-wrapper usuarios-wrapper">
    <div class="usuarios-breadcrumb">
        <a href="{{ route('admin.users.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Voltar para Lista
        </a>
    </div>

    <div class="card usuarios-card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-edit me-2"></i>
                Editar Usuário
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="usuarios-form">
                @csrf
                @method('PUT')

                @include('admin.components.formulario-user', ['user' => $user])

                <div class="usuarios-form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Atualizar Usuário
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection