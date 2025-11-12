// Dados dos itens disponíveis no estoque são carregados do backend via window.itensDisponiveis
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

    // Verificar se há itens disponíveis
    if (itensDisponiveis.length === 0) {
        itensContainer.innerHTML = `
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-exclamation-triangle"></i> Não há itens disponíveis no estoque para envio.
            </div>
        `;
        addItemBtn.disabled = true;
        return;
    }

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
                        <div class="col-md-6">
                            <label class="form-label d-inline-flex">Item<span class="text-danger px-1">* </span></label>
                            <select class="form-select item-select" name="itens[${itemIndex}][item_id]" data-item-index="${itemIndex}" required>
                                <option value="">Selecione um item</option>
                                ${gerarOpcoesItens()}
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label d-inline-flex">Quantidade<span class="text-danger px-1">* </span></label>
                            <input type="number" class="form-control quantidade-input" name="itens[${itemIndex}][quantidade]" min="1" value="1" data-item-index="${itemIndex}" required>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Disponível</label>
                            <input type="text" class="form-control estoque-disponivel" id="estoque-${itemIndex}" readonly disabled>
                        </div>
                    </div>

                    <!-- Container para campos condicionais (ocultos) -->
                    <div class="campos-condicionais d-none" id="campos-condicionais-${itemIndex}"></div>
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

        // Adicionar evento para validar quantidade
        const quantidadeInput = itensContainer.querySelector(`input[data-item-index="${itemIndex}"].quantidade-input`);
        quantidadeInput.addEventListener('input', function() {
            validarQuantidade(itemIndex);
        });
    }

    function gerarOpcoesItens() {
        // Agrupar itens por ID (mesmo item pode ter diferentes características)
        const itensAgrupados = {};
        
        itensDisponiveis.forEach(item => {
            const chave = gerarChaveItem(item);
            if (!itensAgrupados[chave]) {
                itensAgrupados[chave] = item;
            }
        });

        return Object.values(itensAgrupados).map(item => {
            const descricao = gerarDescricaoItem(item);
            return `<option value="${item.id}" 
                        data-validade="${item.validade ? item.validade : ''}" 
                        data-condicao="${item.condicao || ''}" 
                        data-tamanho-valor="${item.tamanho_valor || ''}"
                        data-tamanho-unidade="${item.tamanho_unidade || ''}"
                        data-tamanho-texto="${item.tamanho_texto || ''}"
                        data-quantidade-disponivel="${item.quantidade_disponivel}"
                        data-possui-validade="${item.possui_validade}"
                        data-possui-condicao="${item.possui_condicao}"
                        data-possui-tamanho="${item.possui_tamanho}">
                        ${item.nome} - ${item.categoria} ${descricao}
                    </option>`;
        }).join('');
    }

    function gerarChaveItem(item) {
        let chave = `${item.id}|${item.validade || 'null'}|${item.condicao || 'null'}`;
        if (item.tamanho_valor && item.tamanho_unidade) {
            chave += `|${item.tamanho_valor}_${item.tamanho_unidade}`;
        } else if (item.tamanho_texto) {
            chave += `|${item.tamanho_texto}`;
        } else {
            chave += `|null`;
        }
        return chave;
    }

    function gerarDescricaoItem(item) {
        let descricao = '';
        if (item.validade) {
            const dataValidade = new Date(item.validade);
            descricao += ` (Val: ${dataValidade.toLocaleDateString('pt-BR')})`;
        }
        if (item.condicao) {
            descricao += ` (${item.condicao})`;
        }
        if (item.tamanho_valor && item.tamanho_unidade) {
            descricao += ` (${item.tamanho_valor}${item.tamanho_unidade})`;
        } else if (item.tamanho_texto) {
            descricao += ` (${item.tamanho_texto})`;
        }
        return descricao;
    }

    function handleItemChange(itemIndex, selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        
        if (!selectedOption.value) {
            document.getElementById(`estoque-${itemIndex}`).value = '';
            document.getElementById(`campos-condicionais-${itemIndex}`).innerHTML = '';
            return;
        }

        const quantidadeDisponivel = selectedOption.getAttribute('data-quantidade-disponivel');
        const validade = selectedOption.getAttribute('data-validade');
        const condicao = selectedOption.getAttribute('data-condicao');
        const tamanhoValor = selectedOption.getAttribute('data-tamanho-valor');
        const tamanhoUnidade = selectedOption.getAttribute('data-tamanho-unidade');
        const tamanhoTexto = selectedOption.getAttribute('data-tamanho-texto');

        // Atualizar campo de estoque disponível
        document.getElementById(`estoque-${itemIndex}`).value = quantidadeDisponivel;

        // Atualizar limite máximo de quantidade
        const quantidadeInput = document.querySelector(`input[data-item-index="${itemIndex}"].quantidade-input`);
        quantidadeInput.max = quantidadeDisponivel;

        // Adicionar campos hidden com os valores específicos do item selecionado
        const camposContainer = document.getElementById(`campos-condicionais-${itemIndex}`);
        let camposHtml = '';

        if (validade) {
            camposHtml += `<input type="hidden" name="itens[${itemIndex}][validade]" value="${validade}">`;
        }
        if (condicao) {
            camposHtml += `<input type="hidden" name="itens[${itemIndex}][condicao]" value="${condicao}">`;
        }
        if (tamanhoValor && tamanhoUnidade) {
            camposHtml += `<input type="hidden" name="itens[${itemIndex}][tamanho_valor]" value="${tamanhoValor}">`;
            camposHtml += `<input type="hidden" name="itens[${itemIndex}][tamanho_unidade]" value="${tamanhoUnidade}">`;
        } else if (tamanhoTexto) {
            camposHtml += `<input type="hidden" name="itens[${itemIndex}][tamanho_texto]" value="${tamanhoTexto}">`;
        }

        camposContainer.innerHTML = camposHtml;
        
        // Validar quantidade
        validarQuantidade(itemIndex);
    }

    function validarQuantidade(itemIndex) {
        const itemSelect = document.querySelector(`select[data-item-index="${itemIndex}"]`);
        const quantidadeInput = document.querySelector(`input[data-item-index="${itemIndex}"].quantidade-input`);
        
        if (!itemSelect.value) return;

        const selectedOption = itemSelect.options[itemSelect.selectedIndex];
        const quantidadeDisponivel = parseInt(selectedOption.getAttribute('data-quantidade-disponivel'));
        const quantidadeSolicitada = parseInt(quantidadeInput.value);

        if (quantidadeSolicitada > quantidadeDisponivel) {
            quantidadeInput.classList.add('is-invalid');
            quantidadeInput.setCustomValidity('Quantidade maior que o disponível em estoque');
        } else {
            quantidadeInput.classList.remove('is-invalid');
            quantidadeInput.setCustomValidity('');
        }
    }

    function removeItem(itemIndex) {
        const itemCard = itensContainer.querySelector(`.item-doacao[data-item-index="${itemIndex}"]`);
        if (itemCard) {
            itemCard.remove();
        }
    }
});
