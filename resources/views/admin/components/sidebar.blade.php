<!-- Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
    <x-heroicon-o-bars-3 />
</button>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <div class="logo-icon">A+</div>
        <div class="logo-text">Apoia+</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <x-heroicon-o-home class="nav-icon" />
            <span>Visão Geral</span>
        </a>

        <!-- Cadastros -->
        <div class="nav-item-group">
            <button class="nav-item nav-toggle" data-toggle="cadastros">
                <div class="nav-item-content">
                    <x-heroicon-o-folder class="nav-icon" />
                    <span>Cadastros</span>
                </div>
                <x-heroicon-o-chevron-down class="nav-arrow" />
            </button>
            <div class="nav-submenu" id="cadastros-submenu">
                {{-- Usuários - apenas Admin --}}
                @can('manage-users')
                <a href="{{ route('admin.users.index') }}" class="nav-subitem {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <x-heroicon-o-users class="nav-icon" />
                    <span>Usuários</span>
                </a>
                @endcan

                {{-- Doador / Instituição - Admin e Gerente --}}
                @can('manage-doadores')
                <a href="{{ route('admin.doadores.index') }}" class="nav-subitem {{ request()->routeIs('admin.doadores.*') ? 'active' : '' }}">
                    <x-heroicon-o-currency-dollar class="nav-icon" />
                    <span>Doador / Instituição</span>
                </a>
                @endcan

                {{-- Categorias / Campanhas - Admin e Gerente --}}
                @can('manage-categories')
                <a href="{{ route('admin.cadastros.index') }}" class="nav-subitem {{ request()->routeIs('admin.cadastros.*') ? 'active' : '' }}">
                    <x-heroicon-o-briefcase class="nav-icon" />
                    <span>Categorias / Campanhas</span>
                </a>
                @endcan

                {{-- Itens - Admin e Gerente --}}
                @can('manage-items')
                <a href="{{ route('admin.item.index') }}" class="nav-subitem {{ request()->routeIs('admin.item.*') ? 'active' : '' }}">
                    <x-heroicon-o-inbox-stack class="nav-icon" />
                    <span>Itens</span>
                </a>
                @endcan
            </div>
        </div>

        <!-- Doações -->
        <div class="nav-item-group">
            <button class="nav-item nav-toggle" data-toggle="doacoes">
                <div class="nav-item-content">
                    <x-heroicon-s-user-group class="nav-icon" />
                    <span>Doações</span>
                </div>
                <x-heroicon-o-chevron-down class="nav-arrow" />
            </button>
            <div class="nav-submenu" id="doacoes-submenu">
                {{-- Receber Doação - todos podem --}}
                @can('receive-donations')
                <a href="{{ route('admin.receber-doacaos.index') }}" class="nav-subitem {{ request()->routeIs('admin.receber-doacaos.*') ? 'active' : '' }}">
                    <x-heroicon-o-arrow-down-circle class="nav-icon" />
                    <span>Receber Doação</span>
                </a>
                @endcan

                {{-- Enviar Doação - Admin e Gerente --}}
                @can('send-donations')
                <a href="#" class="nav-subitem">
                    <x-heroicon-o-arrow-up-circle class="nav-icon" />
                    <span>Enviar Doação</span>
                </a>
                @endcan
            </div>
        </div>

        <!-- Relatórios -->
        <div class="nav-item-group">
            <button class="nav-item nav-toggle" data-toggle="relatorios">
                <div class="nav-item-content">
                    <x-heroicon-o-document-text class="nav-icon" />
                    <span>Relatórios</span>
                </div>
                <x-heroicon-o-chevron-down class="nav-arrow" />
            </button>
            <div class="nav-submenu" id="relatorios-submenu">
                {{-- Estoque - todos podem visualizar --}}
                @can('view-stock')
                <a href="{{ route('admin.estoque.index') }}" class="nav-subitem {{ request()->routeIs('admin.estoque.*') ? 'active' : '' }}">
                    <x-vaadin-stock class="nav-icon" />
                    <span>Estoque</span>
                </a>
                @endcan

                {{-- Relatórios - Admin e Gerente --}}
                @can('view-reports')
                <a href="{{ route('admin.relatorio.index') }}" class="nav-subitem {{ request()->routeIs('admin.relatorio.*') ? 'active' : '' }}">
                    <x-heroicon-o-chart-bar class="nav-icon" />
                    <span>Relatórios</span>
                </a>
                @endcan
            </div>
        </div>

        {{-- Auditoria - apenas Admin --}}
        @can('view-audit')
        <a href="{{ route('admin.auditoria.index') }}" class="nav-item {{ request()->routeIs('admin.auditoria.*') ? 'active' : '' }}">
            <x-hugeicons-help-square class="nav-icon" />
            <span>Auditoria - Logs</span>
        </a>
        @endcan

    </nav>

    <a href="{{ route('admin.profile.index') }}" class="user-profile">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div class="user-info">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
        </div>
    </a>

    <form method="POST" action="{{ route('logout') }}" class="btn-sair">
        @csrf
        <button type="submit" class="logout-btn">
            <x-heroicon-o-arrow-right-on-rectangle class="nav-icon" />
            <span>Sair</span>
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebar && sidebarToggle && sidebarOverlay) {
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }

            sidebarToggle.addEventListener('click', toggleSidebar);
            sidebarOverlay.addEventListener('click', toggleSidebar);

            // Fechar sidebar ao clicar em um link (mobile)
            if (window.innerWidth <= 991) {
                const navLinks = sidebar.querySelectorAll('.nav-item, .nav-subitem');
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    });
                });
            }
        }

        // Toggle dos submenus
        const navToggles = document.querySelectorAll('.nav-toggle');

        // Carregar estado dos menus do localStorage
        const openMenus = JSON.parse(localStorage.getItem('openMenus') || '[]');
        openMenus.forEach(menuId => {
            const submenu = document.getElementById(menuId + '-submenu');
            const toggle = document.querySelector(`[data-toggle="${menuId}"]`);
            if (submenu && toggle) {
                submenu.classList.add('show');
                toggle.classList.add('active');
            }
        });

        // Verificar se há subitem ativo e abrir o menu pai
        document.querySelectorAll('.nav-subitem.active').forEach(subitem => {
            const submenu = subitem.closest('.nav-submenu');
            const toggle = submenu?.previousElementSibling;
            if (submenu && toggle) {
                submenu.classList.add('show');
                toggle.classList.add('active');

                // Salvar no localStorage
                const menuId = toggle.getAttribute('data-toggle');
                if (menuId && !openMenus.includes(menuId)) {
                    openMenus.push(menuId);
                    localStorage.setItem('openMenus', JSON.stringify(openMenus));
                }
            }
        });

        navToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const menuId = this.getAttribute('data-toggle');
                const submenu = document.getElementById(menuId + '-submenu');

                if (submenu) {
                    const isOpen = submenu.classList.contains('show');

                    submenu.classList.toggle('show');
                    this.classList.toggle('active');

                    // Salvar estado no localStorage
                    let openMenus = JSON.parse(localStorage.getItem('openMenus') || '[]');
                    if (isOpen) {
                        openMenus = openMenus.filter(id => id !== menuId);
                    } else {
                        if (!openMenus.includes(menuId)) {
                            openMenus.push(menuId);
                        }
                    }
                    localStorage.setItem('openMenus', JSON.stringify(openMenus));
                }
            });
        });
    });
</script>