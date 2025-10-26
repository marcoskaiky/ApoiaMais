document.addEventListener('DOMContentLoaded', function() {
    // Manter a aba ativa após busca ou reload
    const urlParams = new URLSearchParams(window.location.search);

    // Se há busca de campanha, ativa a aba de campanhas
    if (urlParams.has('search_campanha')) {
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

    // Se há busca de categoria, mantém na aba de categorias (padrão)
    // Já está ativa por padrão, então não precisa fazer nada
});
