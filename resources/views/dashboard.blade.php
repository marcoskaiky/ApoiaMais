<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Apoia+</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="admin-wrapper">
        
        @include('admin.components.sidebar')

        
        <div class="main-content">
            <div class="container-fluid py-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="ratio ratio-16x9" style="min-height: 70vh;">
                            <iframe
                                src="http://127.0.0.1:8501/?embed=true&theme=dark"
                                title="Apoia+ Dashboard"
                                style="border:0; width: 100%; height: 100%; border-radius: .5rem;"
                                allow="fullscreen"
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
