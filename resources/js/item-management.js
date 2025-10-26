document.addEventListener('DOMContentLoaded', function() {
    // Manter a aba ativa após busca, edição ou exclusão
    const urlParams = new URLSearchParams(window.location.search);
    
    // Se há busca de item ou parâmetro tab=lista, ativa a aba de itens cadastrados
    if (urlParams.has('search_item') || urlParams.get('tab') === 'lista') {
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

            // Preencher o formulário do modal
            document.getElementById('edit_nome').value = nome;
            document.getElementById('edit_categoria_id').value = categoriaId;
            document.getElementById('edit_estoque_minimo').value = estoque;
            document.getElementById('edit_validade').checked = validade;
            document.getElementById('edit_condicao').checked = condicao;

            // Atualizar a action do formulário
            document.getElementById('editItemForm').action = `/admin/item/${itemId}`;

            // Abrir o modal
            const modal = new bootstrap.Modal(document.getElementById('editItemModal'));
            modal.show();
        });
    });
});
