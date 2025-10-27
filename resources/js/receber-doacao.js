// Dados dos itens são carregados do backend via window.itensDisponiveis
const itensDisponiveis = window.itensDisponiveis || [];

let itemCounter = 0;

document.addEventListener('DOMContentLoaded', function() {
    // Persistência de aba
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab') === 'historico' || urlParams.has('page')) {
        const historicoTab = new bootstrap.Tab(document.getElementById('historico-tab'));
        historicoTab.show();
    }

    // Atualizar URL quando mudar de aba
    const tabElements = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabElements.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            if (event.target.id === 'historico-tab') {
                const url = new URL(window.location);
                url.searchParams.set('tab', 'historico');
                window.history.replaceState({}, '', url);
            } else {
                const url = new URL(window.location);
                url.searchParams.delete('tab');
                window.history.replaceState({}, '', url);
            }
        });
    });

    const addItemBtn = document.getElementById('addItemBtn');
    const itensContainer = document.getElementById('itensContainer');

    // Adicionar primeiro item automaticamente
    addNovoItem();

    // Evento para adicionar novo item
    addItemBtn.addEventListener('click', function() {
        addNovoItem();
    });

    function addNovoItem() {
        const itemIndex = itemCounter++;

        const itemHtml = `
            <div class="card mb-3 item-doacao" data-item-index="${itemIndex}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Item ${itemIndex + 1}</h6>
                        ${itemIndex > 0 ? `<button type="button" class="btn btn-sm btn-danger remove-item-btn" data-item-index="${itemIndex}">
                            <i class="fas fa-trash"></i>
                        </button>` : ''}
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label d-inline-flex">Item<span class="text-danger px-1">* </span></label>
                            <select class="form-select item-select" name="itens[${itemIndex}][item_id]" data-item-index="${itemIndex}" required>
                                <option value="">Selecione um item</option>
                                ${itensDisponiveis.map(item => `
                                    <option value="${item.id}" data-validade="${item.validade}" data-condicao="${item.condicao}" data-tamanho="${item.tamanho}">
                                        ${item.nome} - ${item.categoria}
                                    </option>
                                `).join('')}
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label d-inline-flex">Quantidade<span class="text-danger px-1">* </span></label>
                            <input type="number" class="form-control" name="itens[${itemIndex}][quantidade]" min="1" value="1" required>
                        </div>
                    </div>

                    <!-- Container para campos condicionais -->
                    <div class="campos-condicionais" id="campos-condicionais-${itemIndex}"></div>
                </div>
            </div>
        `;

        itensContainer.insertAdjacentHTML('beforeend', itemHtml);

        // Adicionar evento para remover item
        const removeBtn = itensContainer.querySelector(`[data-item-index="${itemIndex}"].remove-item-btn`);
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                removeItem(itemIndex);
            });
        }

        // Adicionar evento para o select de item
        const itemSelect = itensContainer.querySelector(`select[data-item-index="${itemIndex}"]`);
        itemSelect.addEventListener('change', function() {
            handleItemChange(itemIndex, this);
        });
    }

    function handleItemChange(itemIndex, selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const temValidade = selectedOption.getAttribute('data-validade') === 'true';
        const temCondicao = selectedOption.getAttribute('data-condicao') === 'true';
        const temTamanho = selectedOption.getAttribute('data-tamanho') === 'true';

        const camposContainer = document.getElementById(`campos-condicionais-${itemIndex}`);
        camposContainer.innerHTML = '';

        if (temValidade || temCondicao || temTamanho) {
            let camposHtml = '<div class="row">';

            // Campo de Validade
            if (temValidade) {
                camposHtml += `
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-inline-flex">Data de Validade<span class="text-danger px-1">* </span></label>
                        <input type="date" class="form-control" name="itens[${itemIndex}][validade]" required>
                    </div>
                `;
            }

            // Campo de Condição
            if (temCondicao) {
                camposHtml += `
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-inline-flex">Condição<span class="text-danger px-1">* </span></label>
                        <select class="form-select" name="itens[${itemIndex}][condicao]" required>
                            <option value="">Selecione a condição</option>
                            <option value="novo">Novo</option>
                            <option value="semi-novo">Semi-novo</option>
                            <option value="usado">Usado</option>
                        </select>
                    </div>
                `;
            }

            // Campos de Tamanho
            if (temTamanho) {
                // Se tem VALIDADE e TAMANHO: campo numérico + unidade de medida
                if (temValidade) {
                    camposHtml += `
                        <div class="col-md-4 mb-3">
                            <label class="form-label d-inline-flex">Tamanho<span class="text-danger px-1">* </span></label>
                            <input type="number" step="0.01" class="form-control" name="itens[${itemIndex}][tamanho_valor]" placeholder="Ex: 5" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label d-inline-flex">Unidade<span class="text-danger px-1">* </span></label>
                            <select class="form-select" name="itens[${itemIndex}][tamanho_unidade]" required>
                                <option value="">Selecione</option>
                                <option value="kg">KG</option>
                                <option value="g">Gramas</option>
                                <option value="l">Litros</option>
                                <option value="ml">ML</option>
                            </select>
                        </div>
                    `;
                }
                // Se tem CONDIÇÃO e TAMANHO (sem validade): campo alfanumérico
                else if (temCondicao) {
                    camposHtml += `
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-inline-flex">Tamanho<span class="text-danger px-1">* </span></label>
                            <input type="text" class="form-control" name="itens[${itemIndex}][tamanho_texto]" placeholder="Ex: G, M, P, 42, etc" required>
                        </div>
                    `;
                }
                // Se tem apenas TAMANHO (sem validade nem condição): campo alfanumérico
                else {
                    camposHtml += `
                        <div class="col-md-6 mb-3">
                            <label class="form-label d-inline-flex">Tamanho<span class="text-danger px-1">* </span></label>
                            <input type="text" class="form-control" name="itens[${itemIndex}][tamanho_texto]" placeholder="Ex: G, M, P, 42, etc" required>
                        </div>
                    `;
                }
            }

            camposHtml += '</div>';
            camposContainer.innerHTML = camposHtml;
        }
    }

    function removeItem(itemIndex) {
        const itemCard = itensContainer.querySelector(`.item-doacao[data-item-index="${itemIndex}"]`);
        if (itemCard) {
            itemCard.remove();
        }
    }
});
