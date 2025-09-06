<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto - @yield('title', 'Pacientes')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pacientes.index') }}">Gestión de Pacientes</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} Mi Proyecto</small>
    </footer>
</body>
</html>
