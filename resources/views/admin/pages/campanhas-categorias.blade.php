@extends('admin.dashboard')

@push('scripts')
    @vite(['resources/js/campanhas-categorias.js'])
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
                                    <input type="text" name="search_categoria" class="form-control form-control-sm" placeholder="Buscar categorias..." value="{{ request('search_categoria') }}" style="width: 200px;">
                                    <button type="submit" class="btn-sm btn-buscar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search_categoria'))
                                        <a href="{{ route('admin.cadastros.index') }}" class="btn btn-sm btn-danger">
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
                                            <tr>
                                                <td>{{ $categoria->nome }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                                            Excluir
                                                        </button>
                                                    </form>
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
                                    <input type="text" name="search_campanha" class="form-control form-control-sm" placeholder="Buscar campanhas..." value="{{ request('search_campanha') }}" style="width: 200px;">
                                    <button type="submit" class="btn-sm btn-buscar">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if(request('search_campanha'))
                                        <a href="{{ route('admin.cadastros.index') }}#campanhas" class="btn btn-sm btn-danger">
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
                                            <th class="text-end">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody id="campanhasTableBody">
                                        @forelse($tipoCampanhas as $tipoCampanha)
                                            <tr>
                                                <td>{{ $tipoCampanha->nome }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('admin.tipos-campanha.destroy', $tipoCampanha->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta campanha?')">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">Nenhuma campanha cadastrada</td>
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
