@extends('admin.dashboard')

@push('scripts')
    @vite(['resources/js/item-management.js', 'resources/js/sweet-delete.js'])
@endpush

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gerenciar Itens</h1>
    </div>

    <p class="text-muted mb-4">Cadastro e gerenciamento de itens do estoque.</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Navegação por Abas -->
    <ul class="nav nav-tabs mb-4" id="itensTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro"
                type="button" role="tab" aria-controls="cadastro" aria-selected="true">
                Cadastro de Itens
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="lista-tab" data-bs-toggle="tab" data-bs-target="#lista"
                type="button" role="tab" aria-controls="lista" aria-selected="false">
                Itens Cadastrados
            </button>
        </li>
    </ul>

    <div class="tab-content" id="itensTabContent">
        <!-- Aba Cadastro de Itens -->
        <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Cadastro de Itens</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.item.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <!-- Primeira Linha: Categoria e Checkboxes -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Categoria</label>
                                <select class="form-select @error('categoria_id') is-invalid @enderror" name="categoria_id" id="categoria_id" required>
                                    <option value="" selected>Selecione uma categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label d-block">Características</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="validade" id="validade" value="1">
                                    <label class="form-check-label" for="validade">
                                        Validade
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="condicao" id="condicao" value="1">
                                    <label class="form-check-label" for="condicao">
                                        Condição
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tamanho" id="tamanho" value="1">
                                    <label class="form-check-label" for="tamanho">
                                        Tamanho
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Segunda Linha: Nome e Estoque Mínimo -->
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label class="form-label">Nome do Item</label>
                                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" placeholder="Ex: Arroz 5kg" autocomplete="off" value="{{ old('nome') }}" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label" for="estoque_minimo">Estoque Mínimo</label>
                                <input type="number" name="estoque_minimo" id="estoque_minimo" class="form-control @error('estoque_minimo') is-invalid @enderror" value="{{ old('estoque_minimo', 0) }}" min="0" required>
                                @error('estoque_minimo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar Item</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Aba Itens Cadastrados -->
        <div class="tab-pane fade" id="lista" role="tabpanel" aria-labelledby="lista-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Itens Cadastrados</h5>
                    <div class="d-flex gap-2">
                        <form method="GET" action="{{ route('admin.item.index') }}" class="d-flex gap-2">
                            <input type="hidden" name="tab" value="lista">
                            <input type="text" name="search_item" class="form-control form-control-sm" placeholder="Buscar itens..." value="{{ request('search_item') }}" style="width: 200px;">
                            <button type="submit" class="btn-sm btn-buscar">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search_item'))
                                <a href="{{ route('admin.item.index', ['tab' => 'lista']) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="itemsTable">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Estoque Mínimo</th>
                                    <th>Validade</th>
                                    <th>Condição</th>
                                    <th>Tamanho</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="itemsTableBody">
                                @forelse($itens as $item)
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td>{{ $item->categoria->nome ?? '-' }}</td>
                                    <td>{{ $item->estoque_minimo }}</td>
                                    <td>
                                        @if($item->validade)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-secondary">Não</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->condicao)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-secondary">Não</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->tamanho)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-secondary">Não</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn-sm btn-edit-item"
                                                data-id="{{ $item->id }}"
                                                data-nome="{{ $item->nome }}"
                                                data-categoria="{{ $item->categoria_id }}"
                                                data-estoque="{{ $item->estoque_minimo }}"
                                                data-validade="{{ $item->validade ? '1' : '0' }}"
                                                data-condicao="{{ $item->condicao ? '1' : '0' }}"
                                                data-tamanho="{{ $item->tamanho ? '1' : '0' }}"
                                                title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-sm btn-excluir-item btn-delete" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Nenhum item cadastrado.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Paginação de Itens -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $itens->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Edição -->
    @include('admin.components.item-edit-modal')
</div>
@endsection


