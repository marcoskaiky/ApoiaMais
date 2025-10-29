@extends('admin.dashboard')

@section('content')
@vite('resources/css/usuarios.css')

<div class="content-wrapper usuarios-wrapper">
    <div class="usuarios-header">
        <h1 class="h3 text-gray-800">Gerenciar Usuários</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>
            Adicionar Usuário
        </a>
    </div>

    <p class="usuarios-description">Gerencie os usuários do sistema com diferentes níveis de acesso.</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Barra de Busca -->
    <div class="usuarios-search">
        <form action="{{ route('admin.users.index') }}" method="GET">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Buscar por nome ou e-mail..."
                    value="{{ request('search') }}">
                <button class="btn btn-search" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Card Principal -->
    <div class="card usuarios-card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Lista de Usuários</h5>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table usuarios-table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Nível de Acesso</th>
                            <th>Status</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                <span class="badge badge-role admin">
                                    <i class="fas fa-crown me-1"></i>
                                    Administrador
                                </span>
                                @elseif($user->role === 'gerente')
                                <span class="badge badge-role gerente">
                                    <i class="fas fa-user-tie me-1"></i>
                                    Gerente
                                </span>
                                @else
                                <span class="badge badge-role operador">
                                    <i class="fas fa-user me-1"></i>
                                    Operador
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($user->status ?? true)
                                <span class="badge badge-status ativo">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Ativo
                                </span>
                                @else
                                <span class="badge badge-status inativo">
                                    <i class="fas fa-times-circle me-1"></i>
                                    Inativo
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="usuarios-actions justify-content-end">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary btn-edit">
                                        <i class="fas fa-edit me-1"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja remover este usuário?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-delete">
                                            <i class="fas fa-trash me-1"></i> Remover
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
            <div class="usuarios-pagination">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
            @endif
            @else
            <div class="usuarios-empty">
                <i class="fas fa-users"></i>
                <p>
                    @if(request('search'))
                    Nenhum usuário encontrado para "{{ request('search') }}".
                    @else
                    Nenhum usuário cadastrado ainda.
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection