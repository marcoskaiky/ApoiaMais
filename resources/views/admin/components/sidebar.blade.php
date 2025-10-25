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

        <a href="#" class="nav-item">
            <x-heroicon-o-briefcase class="nav-icon" />
            <span>Campanhas</span>
        </a>

        <a href="{{ route('admin.item.index') }}" class="nav-item">
            <x-heroicon-o-currency-dollar class="nav-icon" />
            <span>Doações</span>
        </a>

        <a href="#" class="nav-item">
            <x-heroicon-o-bell class="nav-icon" />
            <span>Notificações</span>
        </a>
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
                const navLinks = sidebar.querySelectorAll('.nav-item');
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    });
                });
            }
        }
    });
</script>
