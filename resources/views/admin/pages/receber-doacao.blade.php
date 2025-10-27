@extends('admin.dashboard')

@push('scripts')
    <script>
        // Passar dados dos itens para o JavaScript
        window.itensDisponiveis = @json($itensFormatados);
    </script>
    @vite(['resources/js/receber-doacao.js', 'resources/js/sweet-delete.js'])
@endpush

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Receber Doações</h1>
    </div>

    <p class="text-muted mb-4">Registre e acompanhe as doações recebidas.</p>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <!-- Navegação por Abas -->
    <ul class="nav nav-tabs mb-4" id="doacoesTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro"
                type="button" role="tab" aria-controls="cadastro" aria-selected="true">
                Registrar Doação
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="historico-tab" data-bs-toggle="tab" data-bs-target="#historico"
                type="button" role="tab" aria-controls="historico" aria-selected="false">
                Histórico de Doações
            </button>
        </li>
    </ul>

    <div class="tab-content" id="doacoesTabContent">
        <!-- Aba Registrar Doação -->
        <div class="tab-pane fade show active" id="cadastro" role="tabpanel" aria-labelledby="cadastro-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Registrar Nova Doação</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.receber-doacaos.store') }}" method="POST" autocomplete="off" id="formDoacao">
                        @csrf

                        <!-- Primeira Linha: Doador e Campanha -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label d-inline-flex">Doador<span class="text-danger px-1">*</span></label>
                                <select class="form-select @error('doador_id') is-invalid @enderror" name="doador_id" id="doador_id" required>
                                    <option value="" selected>Selecione um doador</option>
                                    @foreach($doadores as $doador)
                                        <option value="{{ $doador->id }}" {{ old('doador_id') == $doador->id ? 'selected' : '' }}>
                                            {{ $doador->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('doador_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="campanha_id">Campanha (Opcional)</label>
                                <select class="form-select @error('campanha_id') is-invalid @enderror" name="campanha_id" id="campanha_id">
                                    <option value="">Nenhuma campanha</option>
                                    @foreach($campanhas as $campanha)
                                        <option value="{{ $campanha->id }}" {{ old('campanha_id') == $campanha->id ? 'selected' : '' }}>
                                            {{ $campanha->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('campanha_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Seção de Itens -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label d-inline-flex">Itens da Doação<span class="text-danger px-1">* </span></label>
                                <button type="button" class="btn btn-sm btn-primary" id="addItemBtn">
                                    <i class="fas fa-plus"></i> Adicionar Item
                                </button>
                            </div>

                            <div id="itensContainer">
                                <!-- Itens serão adicionados aqui dinamicamente -->
                            </div>
                        </div>

                        <!-- Observações -->
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label" for="observacoes">Observações (Opcional)</label>
                                <textarea name="observacoes" id="observacoes" class="form-control @error('observacoes') is-invalid @enderror" rows="3" placeholder="Informações adicionais sobre a doação...">{{ old('observacoes') }}</textarea>
                                @error('observacoes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Registrar Doação
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Aba Histórico de Doações -->
        <div class="tab-pane fade" id="historico" role="tabpanel" aria-labelledby="historico-tab">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Histórico de Doações</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Doador</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Campanha</th>
                                    <th>Qtd. Itens</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($doacoes as $doacao)
                                <tr>
                                    <td>{{ $doacao->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $doacao->doador->nome ?? '-' }}</td>
                                    <td>{{ $doacao->doador->cpf ?? $doacao->doador->cnpj ?? '-' }}</td>
                                    <td>{{ $doacao->campanha->nome ?? '-' }}</td>
                                    <td>{{ $doacao->itens->sum('quantidade') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.receber-doacaos.show', $doacao->id) }}" class="btn-sm btn-action-view" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.receber-doacaos.destroy', $doacao->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-sm btn-excluir-item btn-delete" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Nenhuma doação registrada.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Paginação -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $doacoes->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
