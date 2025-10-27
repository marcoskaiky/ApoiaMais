document.addEventListener('DOMContentLoaded', function() {
    // Manter a aba ativa após busca ou reload
    const urlParams = new URLSearchParams(window.location.search);

    // Se há busca de campanha ou parâmetro tab=campanhas, ativa a aba de campanhas
    if (urlParams.has('search_campanha') || urlParams.get('tab') === 'campanhas' || urlParams.has('page')) {
        const campanhasTab = document.getElementById('campanhas-tab');
        const campanhasPane = document.getElementById('campanhas');
        const categoriasTab = document.getElementById('categorias-tab');
        const categoriasPane = document.getElementById('categorias');

        if (campanhasTab && campanhasPane) {
            categoriasTab.classList.remove('active');
            categoriasPane.classList.remove('show', 'active');
            campanhasTab.classList.add('active');
            campanhasPane.classList.add('show', 'active');
        }
    }

    // Adicionar parâmetro tab=campanhas aos links quando estiver na aba de campanhas
    const campanhasTab = document.getElementById('campanhas-tab');
    if (campanhasTab) {
        campanhasTab.addEventListener('shown.bs.tab', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('tab', 'campanhas');
            window.history.replaceState({}, '', currentUrl);
        });
    }

    // Remover parâmetro tab quando voltar para aba de categorias
    const categoriasTab = document.getElementById('categorias-tab');
    if (categoriasTab) {
        categoriasTab.addEventListener('shown.bs.tab', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.delete('tab');
            window.history.replaceState({}, '', currentUrl);
        });
    }

    // Edição inline de categorias
    document.querySelectorAll('.btn-editar-categoria').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const nomeSpan = row.querySelector('.categoria-nome');
            const formEdit = row.querySelector('.form-edit-categoria');
            const acoesNormais = row.querySelector('.acoes-normais');

            nomeSpan.classList.add('d-none');
            formEdit.classList.remove('d-none');
            acoesNormais.classList.add('d-none');
        });
    });

    // Cancelar edição de categoria
    document.querySelectorAll('.form-edit-categoria .btn-cancelar-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const nomeSpan = row.querySelector('.categoria-nome');
            const formEdit = row.querySelector('.form-edit-categoria');
            const acoesNormais = row.querySelector('.acoes-normais');
            const input = formEdit.querySelector('input[name="nome"]');

            // Restaurar valor original
            input.value = nomeSpan.textContent;

            nomeSpan.classList.remove('d-none');
            formEdit.classList.add('d-none');
            acoesNormais.classList.remove('d-none');
        });
    });

    // Edição inline de campanhas
    document.querySelectorAll('.btn-editar-campanha').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const nomeSpan = row.querySelector('.campanha-nome');
            const formEdit = row.querySelector('.form-edit-campanha');
            const acoesNormais = row.querySelector('.acoes-normais');
            
            // Armazenar valores originais
            const inputNome = formEdit.querySelector('input[name="nome"]');
            const inputMeta = formEdit.querySelector('input[name="meta"]');
            inputNome.dataset.originalValue = inputNome.value;
            inputMeta.dataset.originalValue = inputMeta.value;

            nomeSpan.classList.add('d-none');
            formEdit.classList.remove('d-none');
            acoesNormais.classList.add('d-none');
        });
    });

    // Cancelar edição de campanha
    document.querySelectorAll('.form-edit-campanha .btn-cancelar-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const nomeSpan = row.querySelector('.campanha-nome');
            const formEdit = row.querySelector('.form-edit-campanha');
            const acoesNormais = row.querySelector('.acoes-normais');
            const inputNome = formEdit.querySelector('input[name="nome"]');
            const inputMeta = formEdit.querySelector('input[name="meta"]');

            // Restaurar valores originais
            inputNome.value = inputNome.dataset.originalValue || nomeSpan.textContent;
            inputMeta.value = inputMeta.dataset.originalValue || '';

            nomeSpan.classList.remove('d-none');
            formEdit.classList.add('d-none');
            acoesNormais.classList.remove('d-none');
        });
    });
});
