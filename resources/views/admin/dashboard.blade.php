<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Apoia+</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/backend.css'])
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">A+</div>
            <div class="logo-text">Apoia+</div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <x-heroicon-o-home class="nav-icon" />
                <span>Visão Geral</span>
            </a>

            <a href="#" class="nav-item">
                <x-heroicon-o-briefcase class="nav-icon" />
                <span>Campanhas</span>
            </a>

            <a href="#" class="nav-item">
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
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ $user->name }}</div>
                <div class="user-role">{{ ucfirst($user->role) }}</div>
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

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
