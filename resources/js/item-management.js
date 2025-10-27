document.addEventListener('DOMContentLoaded', function() {
    // Manter a aba ativa após busca, edição ou exclusão
    const urlParams = new URLSearchParams(window.location.search);

    // Se há busca de item, parâmetro tab=lista, ou parâmetro page (paginação), ativa a aba de itens cadastrados
    if (urlParams.has('search_item') || urlParams.get('tab') === 'lista' || urlParams.has('page')) {
        const listaTab = document.getElementById('lista-tab');
        const listaPane = document.getElementById('lista');
        const cadastroTab = document.getElementById('cadastro-tab');
        const cadastroPane = document.getElementById('cadastro');

        if (listaTab && listaPane) {
            cadastroTab.classList.remove('active');
            cadastroPane.classList.remove('show', 'active');
            listaTab.classList.add('active');
            listaPane.classList.add('show', 'active');
        }
    }

    // Adicionar parâmetro tab=lista aos links de paginação quando estiver na aba de lista
    const listaTab = document.getElementById('lista-tab');
    if (listaTab) {
        listaTab.addEventListener('shown.bs.tab', function() {
            // Atualizar URL sem recarregar a página
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('tab', 'lista');
            window.history.replaceState({}, '', currentUrl);
        });
    }

    // Remover parâmetro tab quando voltar para aba de cadastro
    const cadastroTab = document.getElementById('cadastro-tab');
    if (cadastroTab) {
        cadastroTab.addEventListener('shown.bs.tab', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.delete('tab');
            window.history.replaceState({}, '', currentUrl);
        });
    }

    // Abrir modal de edição
    const editButtons = document.querySelectorAll('.btn-edit-item');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const nome = this.dataset.nome;
            const categoriaId = this.dataset.categoria;
            const estoque = this.dataset.estoque;
            const validade = this.dataset.validade === '1';
            const condicao = this.dataset.condicao === '1';
            const tamanho = this.dataset.tamanho === '1';

            // Preencher o formulário do modal
            document.getElementById('edit_nome').value = nome;
            document.getElementById('edit_categoria_id').value = categoriaId;
            document.getElementById('edit_estoque_minimo').value = estoque;
            document.getElementById('edit_validade').checked = validade;
            document.getElementById('edit_condicao').checked = condicao;
            document.getElementById('edit_tamanho').checked = tamanho;

            // Atualizar a action do formulário
            document.getElementById('editItemForm').action = `/admin/item/${itemId}`;

            // Abrir o modal
            const modal = new bootstrap.Modal(document.getElementById('editItemModal'));
            modal.show();
        });
    });
});
