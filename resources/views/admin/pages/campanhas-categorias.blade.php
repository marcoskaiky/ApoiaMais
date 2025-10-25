@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Campanhas / Categorias</h1>
    </div>

    <p class="text-muted mb-4">Gerencie as categorias e campanhas do sistema.</p>

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
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Categorias Existentes</h5>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>CATEGORIA</th>
                                            <th class="text-end">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categorias as $categoria)
                                            <tr>
                                                <td>{{ $categoria->nome }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Campanhas</h5>
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
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="bi bi-plus-circle"></i> Salvar Tipo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Campanhas Existentes</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>CAMPANHA</th>
                                            <th class="text-end">AÇÕES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tipoCampanhas as $tipoCampanha)
                                            <tr>
                                                <td>{{ $tipoCampanha->nome }}</td>
                                                <td class="text-end">
                                                    <form action="{{ route('admin.tipos-campanha.destroy', $tipoCampanha->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>

</style>
@endsection
