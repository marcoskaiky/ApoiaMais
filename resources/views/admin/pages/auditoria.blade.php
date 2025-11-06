@extends('admin.dashboard')

@section('content')
@vite('resources/css/auditoria.css')

<div class="content-wrapper auditoria-wrapper">
    <div class="auditoria-header">
        <h1 class="h3 text-gray-800">Auditoria</h1>
    </div>

    <p class="auditoria-description">Log de atividades do sistema</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Card de Filtros -->
    <div class="auditoria-filtros">
        <form action="{{ route('admin.auditoria.index') }}" method="GET" id="filterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Buscar por usuário, data ou tipo de ação</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" placeholder="Buscar..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Tipo de Ação</label>
                    <select name="tipo_acao" class="form-select">
                        <option value="">Todos</option>
                        <option value="Login" {{ request('tipo_acao') == 'Login' ? 'selected' : '' }}>Login</option>
                        <option value="Logout" {{ request('tipo_acao') == 'Logout' ? 'selected' : '' }}>Logout</option>
                        <option value="Entrada de Item" {{ request('tipo_acao') == 'Entrada de Item' ? 'selected' : '' }}>Entrada de Item</option>
                        <option value="Saída de Item" {{ request('tipo_acao') == 'Saída de Item' ? 'selected' : '' }}>Saída de Item</option>
                        <option value="Cadastro de Item" {{ request('tipo_acao') == 'Cadastro de Item' ? 'selected' : '' }}>Cadastro de Item</option>
                        <option value="Edição de Item" {{ request('tipo_acao') == 'Edição de Item' ? 'selected' : '' }}>Edição de Item</option>
                        <option value="Exclusão de Item" {{ request('tipo_acao') == 'Exclusão de Item' ? 'selected' : '' }}>Exclusão de Item</option>
                        <option value="Criação de Campanha" {{ request('tipo_acao') == 'Criação de Campanha' ? 'selected' : '' }}>Criação de Campanha</option>
                        <option value="Edição de Perfil" {{ request('tipo_acao') == 'Edição de Perfil' ? 'selected' : '' }}>Edição de Perfil</option>
                        <option value="Alteração de Senha" {{ request('tipo_acao') == 'Alteração de Senha' ? 'selected' : '' }}>Alteração de Senha</option>
                        <option value="Cadastro de Usuário" {{ request('tipo_acao') == 'Cadastro de Usuário' ? 'selected' : '' }}>Cadastro de Usuário</option>
                        <option value="Edição de Usuário" {{ request('tipo_acao') == 'Edição de Usuário' ? 'selected' : '' }}>Edição de Usuário</option>
                        <option value="Exclusão de Usuário" {{ request('tipo_acao') == 'Exclusão de Usuário' ? 'selected' : '' }}>Exclusão de Usuário</option>
                        <option value="Cadastro de Doador" {{ request('tipo_acao') == 'Cadastro de Doador' ? 'selected' : '' }}>Cadastro de Doador</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Data Inicial</label>
                    <input type="date" name="data_inicial" class="form-control" value="{{ request('data_inicial') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Data Final</label>
                    <input type="date" name="data_final" class="form-control" value="{{ request('data_final') }}">
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabela de Auditoria -->
    <div class="card auditoria-card shadow-sm">
        <div class="card-header d-flex inline-flex justify-between align-items-center">
            <h5 class="mb-0">Registro de Atividades</h5>
            <span class="badge">{{ $auditorias->total() }} registros</span>
        </div>
        <div class="card-body">
            @if($auditorias->count() > 0)
            <div class="table-responsive">
                <table class="table auditoria-table">
                    <thead>
                        <tr>
                            <th style="width: 15%;">USUÁRIO</th>
                            <th style="width: 20%;">DATA</th>
                            <th style="width: 20%;">TIPO DE AÇÃO</th>
                            <th style="width: 35%;">DETALHES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($auditorias as $auditoria)
                        <tr>
                            <td>
                                <div class="auditoria-usuario">
                                    <i class="fas fa-user-circle"></i>
                                    <strong>{{ $auditoria->usuario->name ?? 'Sistema' }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="auditoria-data">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($auditoria->data_hora)->format('d/m/Y H:i') }}
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-acao 
                                        @if(str_contains(strtolower($auditoria->tipo_acao), 'entrada')) entrada
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'saída') || str_contains(strtolower($auditoria->tipo_acao), 'saida')) saida
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'criação') || str_contains(strtolower($auditoria->tipo_acao), 'criacao')) criacao
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'cadastro')) cadastro
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'edição') || str_contains(strtolower($auditoria->tipo_acao), 'edicao')) edicao
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'exclusão') || str_contains(strtolower($auditoria->tipo_acao), 'exclusao')) exclusao
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'login')) login
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'logout')) logout
                                        @elseif(str_contains(strtolower($auditoria->tipo_acao), 'alteração') || str_contains(strtolower($auditoria->tipo_acao), 'alteracao')) alteracao
                                        @else login
                                        @endif">
                                    {{ $auditoria->tipo_acao }}
                                </span>
                            </td>
                            <td>
                                <div class="auditoria-detalhes">
                                    {{ $auditoria->detalhes }}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($auditorias->hasPages())
            <div class="auditoria-pagination">
                {{ $auditorias->links('vendor.pagination.bootstrap-5') }}
            </div>
            @endif
            @else
            <div class="auditoria-empty">
                <i class="fas fa-clipboard-list"></i>
                <p>
                    @if(request('search') || request('tipo_acao') || request('data_inicial') || request('data_final'))
                    Nenhum registro encontrado com os filtros aplicados.
                    @else
                    Nenhum registro de auditoria ainda.
                    @endif
                </p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection