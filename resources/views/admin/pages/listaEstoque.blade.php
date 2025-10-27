@extends('admin.dashboard')

@section('content')

<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Estoque</h1>
    </div>

    <p class="text-muted mb-4">Visualize os itens em estoque agrupados por características.</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Itens em Estoque</h5>
                <form method="GET" action="" class="d-flex gap-2">
                    <input type="text"
                           name="search"
                           class="form-control form-control-sm"
                           placeholder="Buscar itens..."
                           value="{{ request('search') }}"
                           style="width: 200px;">
                    <button type="submit" class="btn-sm btn-buscar">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="?" class="btn btn-sm btn-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- Legenda das Cores -->
            <div class="alert alert-light border mb-3" role="alert">
                <strong>Legenda da Barra de Progresso:</strong>
                <span class="ms-3">
                    <span class="badge bg-danger">Vermelho</span> Abaixo do estoque mínimo.
                </span>
                <span class="ms-3">
                    <span class="badge bg-warning text-dark">Amarelo</span> Próximo do estoque mínimo.
                </span>
                <span class="ms-3">
                    <span class="badge bg-success">Verde</span> Estoque adequado.
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Categoria</th>
                            <th style="width: 300px;">Quantidade / Estoque Mínimo</th>
                            <th>Validade</th>
                            <th>Tamanho</th>
                            <th>Condição</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($itensAgrupados as $itemAgrupado)
                            <tr>
                                <td class="fw-bold">{{ $itemAgrupado['item']->nome }}</td>
                                <td>{{ $itemAgrupado['item']->categoria->nome ?? '-' }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold" style="min-width: 60px;">
                                            {{ number_format($itemAgrupado['quantidade_total'], 0) }}/{{ number_format($itemAgrupado['item']->estoque_minimo, 0) }}
                                        </span>
                                        <div class="progress flex-grow-1" style="height: 20px;">
                                            <div class="progress-bar bg-{{ $itemAgrupado['cor_barra'] }}"
                                                 role="progressbar"
                                                 style="width: {{ min($itemAgrupado['porcentagem'], 100) }}%;"
                                                 aria-valuenow="{{ $itemAgrupado['porcentagem'] }}"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100">
                                                {{ $itemAgrupado['porcentagem'] }}%
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($itemAgrupado['validade'])
                                        {{ $itemAgrupado['validade']->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($itemAgrupado['tamanho_valor'] && $itemAgrupado['tamanho_unidade'])
                                        {{ number_format($itemAgrupado['tamanho_valor'], 2) }} {{ $itemAgrupado['tamanho_unidade'] }}
                                    @elseif($itemAgrupado['tamanho_texto'])
                                        {{ $itemAgrupado['tamanho_texto'] }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($itemAgrupado['condicao'])
                                        <span class="badge bg-info">{{ ucfirst($itemAgrupado['condicao']) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Nenhum item cadastrado ainda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $todosItens->links('vendor.pagination.custom') }}
            </div>

            <!-- Resumo Geral -->
            @if($itensAgrupados->isNotEmpty())
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="fw-bold mb-2">Resumo do Estoque:</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Total de Itens Diferentes:</strong> {{ $itensAgrupados->count() }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Quantidade Total em Estoque:</strong> {{ number_format($itensAgrupados->sum('quantidade_total'), 0) }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Categorias:</strong> {{ $itensAgrupados->pluck('item.categoria.nome')->unique()->count() }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Paginação e busca são feitas no backend -->

@endsection
