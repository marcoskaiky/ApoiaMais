@extends('admin.dashboard')

@push('scripts')
    @vite(['resources/js/campanhas-categorias.js', 'resources/js/sweet-delete.js'])
@endpush

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categorias / Campanhas</h1>
    </div>

    <p class="text-muted mb-4">Gerencie as categorias e campanhas do sistema.</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Navegação por Abas -->
    <ul class="nav nav-tabs mb-4" id="cadastrosTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="categorias-tab" data-bs-toggle="tab" data-bs-target="#categorias" type="button" role="tab" aria-controls="categorias" aria-selected="true">
                Categorias
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="campanhas-tab" data-bs-toggle="tab" data-bs-target="#campanhas" type="button" role="tab" aria-controls="campanhas" aria-selected="false">
                Campanhas
            </button>
        </li>
    </ul>

    <!-- Conteúdo das Abas -->
    <div class="tab-content" id="cadastrosTabContent">

        <!-- Aba: Categorias de Itens -->
        <div class="tab-pane fade show active" id="categorias" role="tabpanel" aria-labelledby="categorias-tab">
            <div class="row">
                <!-- Formulário para Nova Categoria -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Nova Categoria</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.categorias.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nome_categoria" class="form-label">Nome da Categoria</label>
                                    <input type="text"
                                           class="form-control @error('nome_categoria') is-invalid @enderror"
                                           id="nome_categoria"
                                           name="nome_categoria"
                                           placeholder="Ex: Alimentos não perecíveis"
                                           value="{{ old('nome_categoria') }}"
                                           required>
                                    @error('nome_categoria')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle"></i> Salvar Categoria
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Lista de Categorias Existentes -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Categorias Existentes</h5>
                            <div class="d-flex gap-2">
                                <form method="GET" action="{{ route('admin.cadastros.index') }}" class="d-flex gap-2">
                                    <input type="hidden" name="tab" value="categorias">
                                    <input type="text" name="search_categoria" class="form-control form-control-sm" placeholder="Buscar categorias..." value="{{ request('search_categoria') }}" style="width: 200px;">
                                    <button type="submit" class="btn-sm btn-buscar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search_categoria'))
                                        <a href="{{ route('admin.cadastros.index', ['tab' => 'categorias']) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="categoriasTable">
                                    <thead>
                                        <tr>
                                            <th>CATEGORIA</th>
                                            <th class="text-end">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categoriasTableBody">
                                        @forelse($categorias as $categoria)
                                            <tr data-categoria-id="{{ $categoria->id }}">
                                                <td>
                                                    <span class="categoria-nome">{{ $categoria->nome }}</span>
                                                    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" class="d-none form-edit-categoria">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <input type="text" name="nome" class="form-control form-control-sm" value="{{ $categoria->nome }}" required>
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-secondary btn-cancelar-edit">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="text-end">
                                                    <div class="acoes-normais">
                                                        <button type="button" class="btn-sm btn-edit-item btn-editar-categoria" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-sm btn-excluir-item btn-delete" title="Excluir">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">Nenhuma categoria cadastrada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Paginação de Categorias -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $categorias->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aba: Tipos de Campanha -->
        <div class="tab-pane fade" id="campanhas" role="tabpanel" aria-labelledby="campanhas-tab">
            <div class="row">
                <!-- Formulário para Novo Tipo de Campanha -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Nova Campanha</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.tipos-campanha.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nome_tipo_campanha" class="form-label">Nome da Campanha</label>
                                    <input type="text"
                                           class="form-control @error('nome_tipo_campanha') is-invalid @enderror"
                                           id="nome_tipo_campanha"
                                           name="nome_tipo_campanha"
                                           placeholder="Ex: Arrecadação de Alimentos"
                                           value="{{ old('nome_tipo_campanha') }}"
                                           required>
                                    @error('nome_tipo_campanha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="meta" class="form-label">Meta (Quantidade de Itens)</label>
                                    <input type="number"
                                           class="form-control @error('meta') is-invalid @enderror"
                                           id="meta"
                                           name="meta"
                                           placeholder="Ex: 1000"
                                           value="{{ old('meta') }}"
                                           step="0.01"
                                           min="0">
                                    @error('meta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Deixe em branco se não houver meta definida</small>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-plus-circle"></i> Salvar Campanha
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Campanhas Existentes</h5>
                            <div class="d-flex gap-2">
                                <form method="GET" action="{{ route('admin.cadastros.index') }}" class="d-flex gap-2">
                                    <input type="hidden" name="tab" value="campanhas">
                                    <input type="text" name="search_campanha" class="form-control form-control-sm" placeholder="Buscar campanhas..." value="{{ request('search_campanha') }}" style="width: 200px;">
                                    <button type="submit" class="btn-sm btn-buscar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search_campanha'))
                                        <a href="{{ route('admin.cadastros.index', ['tab' => 'campanhas']) }}" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="campanhasTable">
                                    <thead>
                                        <tr>
                                            <th>CAMPANHA</th>
                                            <th style="width: 30%;">PROGRESSO DA META</th>
                                            <th class="text-end">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="campanhasTableBody">
                                        @forelse($tipoCampanhas as $tipoCampanha)
                                            <tr data-campanha-id="{{ $tipoCampanha->id }}">
                                                <td>
                                                    <span class="campanha-nome">{{ $tipoCampanha->nome }}</span>
                                                    <form action="{{ route('admin.tipos-campanha.update', $tipoCampanha->id) }}" method="POST" class="d-none form-edit-campanha">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <div class="flex-grow-1">
                                                                <input type="text" name="nome" class="form-control form-control-sm mb-2" value="{{ $tipoCampanha->nome }}" placeholder="Nome da campanha" required>
                                                                <input type="number" name="meta" class="form-control form-control-sm" value="{{ $tipoCampanha->meta }}" placeholder="Meta (opcional)" step="0.01" min="0">
                                                            </div>
                                                            <div class="d-flex flex-column gap-1">
                                                                <button type="submit" class="btn btn-sm btn-success">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-secondary btn-cancelar-edit">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    @if($tipoCampanha->meta)
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="flex-grow-1">
                                                                <div class="progress" style="height: 25px;">
                                                                    <div class="progress-bar bg-success"
                                                                         role="progressbar"
                                                                         style="width: {{ $tipoCampanha->porcentagem_meta }}%"
                                                                         aria-valuenow="{{ $tipoCampanha->porcentagem_meta }}"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100">
                                                                        {{ number_format($tipoCampanha->porcentagem_meta, 1) }}%
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <small class="text-muted text-nowrap">
                                                                {{ number_format($tipoCampanha->total_arrecadado, 0) }} / {{ number_format($tipoCampanha->meta, 0) }}
                                                            </small>
                                                        </div>
                                                    @else
                                                        <span class="text-muted">Sem meta definida</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="acoes-normais">
                                                        <button type="button" class="btn-sm btn-edit-item btn-editar-campanha" title="Editar">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.tipos-campanha.destroy', $tipoCampanha->id) }}" method="POST" class="d-inline form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn-sm btn-excluir-item btn-delete" title="Excluir">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Nenhuma campanha cadastrada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Paginação de Campanhas -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $tipoCampanhas->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
