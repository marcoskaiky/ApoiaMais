@extends('admin.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detalhes do Envio</h1>
        <a href="{{ route('admin.enviar-doacaos.index', ['tab' => 'historico']) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <!-- Toast Component -->
    @include('admin.components.toast')

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Envio #{{ $enviarDoacao->id }}</h5>
            <button type="button" class="btn btn-light btn-sm" id="btnEditar">
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.enviar-doacaos.update', $enviarDoacao->id) }}" method="POST" id="formDoacao">
                @csrf
                @method('PUT')

                <!-- Informações do Envio -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Instituição</label>
                        <input type="text" class="form-control" value="{{ $enviarDoacao->instituicao->nome }}" disabled>
                        <input type="hidden" name="instituicao_id" value="{{ $enviarDoacao->instituicao_id }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">CNPJ</label>
                        <input type="text" class="form-control" value="{{ $enviarDoacao->instituicao->cnpj }}" disabled>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Campanha</label>
                        <input type="text" class="form-control" value="{{ $enviarDoacao->campanha->nome ?? 'Nenhuma' }}" disabled>
                        <input type="hidden" name="campanha_id" value="{{ $enviarDoacao->campanha_id }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Data do Envio</label>
                        <input type="text" class="form-control" value="{{ $enviarDoacao->created_at->format('d/m/Y H:i') }}" disabled>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Observações</label>
                        <textarea class="form-control campo-editavel" name="observacoes" rows="3" disabled>{{ $enviarDoacao->observacoes }}</textarea>
                    </div>
                </div>

                <hr>

                <!-- Itens Enviados -->
                <h5 class="mb-3">Itens Enviados</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Categoria</th>
                                <th style="width: 120px;">Quantidade</th>
                                <th>Validade</th>
                                <th>Tamanho</th>
                                <th>Condição</th>
                                <th class="text-center d-none btn-excluir-col" style="width: 60px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enviarDoacao->itens as $index => $itemDoacao)
                            <tr class="item-row" data-item-id="{{ $itemDoacao->id }}">
                                <td>{{ $itemDoacao->item->nome }}</td>
                                <td>{{ $itemDoacao->item->categoria->nome ?? '-' }}</td>
                                <td>
                                    <input type="number" class="form-control form-control-sm campo-editavel"
                                        name="itens[{{ $index }}][quantidade]"
                                        value="{{ $itemDoacao->quantidade }}"
                                        min="1" disabled>
                                    <input type="hidden" name="itens[{{ $index }}][id]" value="{{ $itemDoacao->id }}">
                                </td>
                                <td>
                                    @if($itemDoacao->validade)
                                    <input type="date" class="form-control form-control-sm campo-editavel"
                                        name="itens[{{ $index }}][validade]"
                                        value="{{ $itemDoacao->validade->format('Y-m-d') }}" disabled>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($itemDoacao->tamanho_valor && $itemDoacao->tamanho_unidade)
                                    <div class="d-flex gap-1">
                                        <input type="number" class="form-control form-control-sm campo-editavel"
                                            name="itens[{{ $index }}][tamanho_valor]"
                                            value="{{ $itemDoacao->tamanho_valor }}"
                                            step="0.01" style="width: 70px;" disabled>
                                        <input type="text" class="form-control form-control-sm campo-editavel"
                                            name="itens[{{ $index }}][tamanho_unidade]"
                                            value="{{ $itemDoacao->tamanho_unidade }}"
                                            style="width: 60px;" disabled>
                                    </div>
                                    @elseif($itemDoacao->tamanho_texto)
                                    <input type="text" class="form-control form-control-sm campo-editavel"
                                        name="itens[{{ $index }}][tamanho_texto]"
                                        value="{{ $itemDoacao->tamanho_texto }}" disabled>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($itemDoacao->condicao)
                                    <select class="form-select form-select-sm campo-editavel"
                                        name="itens[{{ $index }}][condicao]" disabled>
                                        <option value="novo" {{ $itemDoacao->condicao == 'novo' ? 'selected' : '' }}>Novo</option>
                                        <option value="semi-novo" {{ $itemDoacao->condicao == 'semi-novo' ? 'selected' : '' }}>Semi-novo</option>
                                        <option value="usado" {{ $itemDoacao->condicao == 'usado' ? 'selected' : '' }}>Usado</option>
                                    </select>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td class="text-center d-none btn-excluir-col">
                                    <button type="button" class="btn btn-sm btn-danger btn-excluir-item-doacao" data-item-id="{{ $itemDoacao->id }}" title="Excluir item">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="2" class="text-end fw-bold">Total de Itens:</td>
                                <td class="fw-bold">{{ $enviarDoacao->itens->sum('quantidade') }}</td>
                                <td colspan="3"></td>
                                <td class="d-none btn-excluir-col"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Botões de ação (ocultos inicialmente) -->
                <div class="mt-4 d-none" id="botoesAcao">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                    <button type="button" class="btn btn-secondary" id="btnCancelar">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnEditar = document.getElementById('btnEditar');
        const btnCancelar = document.getElementById('btnCancelar');
        const botoesAcao = document.getElementById('botoesAcao');
        const camposEditaveis = document.querySelectorAll('.campo-editavel');
        const formDoacao = document.getElementById('formDoacao');
        const colunasExcluir = document.querySelectorAll('.btn-excluir-col');

        // Armazenar valores originais
        let valoresOriginais = {};

        camposEditaveis.forEach((campo, index) => {
            valoresOriginais[index] = campo.value;
        });

        // Ativar modo de edição
        btnEditar.addEventListener('click', function() {
            camposEditaveis.forEach(campo => {
                campo.disabled = false;
                campo.classList.add('border-primary');
            });

            // Mostrar coluna de ações
            colunasExcluir.forEach(col => {
                col.classList.remove('d-none');
            });

            btnEditar.classList.add('d-none');
            botoesAcao.classList.remove('d-none');
        });

        // Cancelar edição
        btnCancelar.addEventListener('click', function() {
            // Restaurar valores originais
            camposEditaveis.forEach((campo, index) => {
                campo.value = valoresOriginais[index];
                campo.disabled = true;
                campo.classList.remove('border-primary');
            });

            // Restaurar itens excluídos
            document.querySelectorAll('.item-row').forEach(row => {
                row.style.display = '';
                const checkbox = row.querySelector('input[name$="[_destroy]"]');
                if (checkbox) {
                    checkbox.checked = false;
                }
            });

            // Ocultar coluna de ações
            colunasExcluir.forEach(col => {
                col.classList.add('d-none');
            });

            btnEditar.classList.remove('d-none');
            botoesAcao.classList.add('d-none');
        });

        // Excluir item
        document.querySelectorAll('.btn-excluir-item-doacao').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                const row = this.closest('.item-row');

                // Marcar para exclusão adicionando um campo hidden
                const destroyInput = document.createElement('input');
                destroyInput.type = 'hidden';
                destroyInput.name = `itens_excluir[]`;
                destroyInput.value = itemId;
                formDoacao.appendChild(destroyInput);

                // Ocultar a linha
                row.style.display = 'none';

                // Marcar que foi excluído
                row.querySelector('input[name$="[_destroy]"]')?.setAttribute('checked', 'true') ||
                    row.appendChild(Object.assign(document.createElement('input'), {
                        type: 'hidden',
                        name: row.querySelector('input[type="hidden"]').name.replace('[id]', '[_destroy]'),
                        value: '1'
                    }));
            });
        });
    });
</script>
@endsection