<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mi Proyecto - @yield('title', 'Pacientes')</title>

    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Heroicons (para íconos SVG) -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gray-50 text-gray-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Branding -->
                <a href="{{ route('welcome') }}" class="flex items-center text-white font-bold text-lg gap-2">
                    <i data-feather="users"></i> Hackaton
                </a>

                <!-- Links -->
                <div class="flex space-x-6">
                    <a href="{{ route('pacientes.index') }}" 
                       class="text-white hover:text-blue-200 {{ request()->routeIs('pacientes.*') ? 'underline font-semibold' : '' }}">
                        Pacientes
                    </a>
                    <a href="{{ route('historias.index') }}" 
                       class="text-white hover:text-blue-200 {{ request()->routeIs('historias.*') ? 'underline font-semibold' : '' }}">
                        Historias Clínicas
                    </a>
                    {{-- Agrega más enlaces si necesitas --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-4 mt-8 shadow-inner">
        <small class="text-gray-500">&copy; {{ date('Y') }} Grupo Black</small>
    </footer>

    <!-- Feather icons -->
    <script>feather.replace()</script>

    @stack('js')
</body>
</html>
