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
                <i class="fas fa-user-plus me-2"></i>
                Adicionar Novo Usuário
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" class="usuarios-form">
                @csrf

                @include('admin.components.formulario-user', ['user' => new App\Models\User()])

                <div class="usuarios-form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>
                        Salvar Usuário
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