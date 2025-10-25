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
    <div class="admin-wrapper">
        <!-- Sidebar Component -->
        @include('admin.components.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
