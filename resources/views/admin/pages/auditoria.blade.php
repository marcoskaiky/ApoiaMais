@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Auditoria</h1>
    </div>

    <p class="text-muted mb-4">Log de atividades do sistema</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Card de Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.auditoria.index') }}" method="GET" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-4">
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
                            <option value="Entrada de Item" {{ request('tipo_acao') == 'Entrada de Item' ? 'selected' : '' }}>Entrada de Item</option>
                            <option value="Saída de Item" {{ request('tipo_acao') == 'Saída de Item' ? 'selected' : '' }}>Saída de Item</option>
                            <option value="Criação de Campanha" {{ request('tipo_acao') == 'Criação de Campanha' ? 'selected' : '' }}>Criação de Campanha</option>
                            <option value="Edição de Perfil" {{ request('tipo_acao') == 'Edição de Perfil' ? 'selected' : '' }}>Edição de Perfil</option>
                            <option value="Cadastro de Usuário" {{ request('tipo_acao') == 'Cadastro de Usuário' ? 'selected' : '' }}>Cadastro de Usuário</option>
                            <option value="Exclusão" {{ request('tipo_acao') == 'Exclusão' ? 'selected' : '' }}>Exclusão</option>
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

                    <div class="col-md-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100%">
                            <i class="fas fa-filter"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabela de Auditoria -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Registro de Atividades</h5>
            <span class="badge bg-light text-dark">{{ $auditorias->total() }} registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 15%;">USUÁRIO</th>
                            <th style="width: 15%;">DATA</th>
                            <th style="width: 20%;">TIPO DE AÇÃO</th>
                            <th style="width: 50%;">DETALHES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($auditorias as $auditoria)
                        <tr>
                            <td>
                                <strong>{{ $auditoria->usuario->name ?? 'Sistema' }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($auditoria->data_hora)->format('d/m/Y H:i') }}
                                </small>
                            </td>
                            <td>
                                <span class="badge 
                                        @if(str_contains($auditoria->tipo_acao, 'Entrada')) bg-success
                                        @elseif(str_contains($auditoria->tipo_acao, 'Saída')) bg-warning
                                        @elseif(str_contains($auditoria->tipo_acao, 'Criação') || str_contains($auditoria->tipo_acao, 'Cadastro')) bg-info
                                        @elseif(str_contains($auditoria->tipo_acao, 'Edição')) bg-primary
                                        @elseif(str_contains($auditoria->tipo_acao, 'Exclusão')) bg-danger
                                        @else bg-secondary
                                        @endif">
                                    {{ $auditoria->tipo_acao }}
                                </span>
                            </td>
                            <td>
                                {{ $auditoria->detalhes }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Nenhum registro encontrado</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($auditorias->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center">
                {{ $auditorias->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection