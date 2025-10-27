<!-- Modal de Edição de Item -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editItemModalLabel">Editar Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editItemForm" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Primeira Linha: Categoria e Checkboxes -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" name="categoria_id" id="edit_categoria_id" required>
                                <option value="">Selecione uma categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Características</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="validade" id="edit_validade" value="1">
                                <label class="form-check-label" for="edit_validade">
                                    Validade
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="condicao" id="edit_condicao" value="1">
                                <label class="form-check-label" for="edit_condicao">
                                    Condição
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tamanho" id="edit_tamanho" value="1">
                                <label class="form-check-label" for="edit_tamanho">
                                    Tamanho
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda Linha: Nome e Estoque Mínimo -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label">Nome do Item</label>
                            <input type="text" name="nome" id="edit_nome" class="form-control" placeholder="Ex: Arroz 5kg" autocomplete="off" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Estoque Mínimo</label>
                            <input type="number" name="estoque_minimo" id="edit_estoque_minimo" class="form-control" min="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
