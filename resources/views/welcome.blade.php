<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hackathon Grupo Black</title>

    <!-- Tailwind desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gradient-to-r from-sky-700 via-blue-800 to-indigo-900 min-h-screen flex items-center justify-center text-white relative overflow-hidden">
    
    <!-- Fondo con círculos animados -->
    <div class="absolute inset-0">
        <div class="absolute w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse top-20 left-10"></div>
        <div class="absolute w-96 h-96 bg-sky-400 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-bounce bottom-10 right-10"></div>
    </div>

    <div class="text-center px-6 relative z-10">
        <!-- Título -->
        <h1 class="text-5xl md:text-6xl font-extrabold mb-6 drop-shadow-lg tracking-wide">
            🚀 Bienvenidos al <span class="text-sky-300">Grupo Black</span>
        </h1>

        <!-- Subtítulo -->
        <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Proyecto creado para la <span class="font-semibold text-sky-200">Hackathon</span>.  
            Innovamos con <span class="text-sky-300">tecnología</span> y <span class="text-sky-300">pasión</span>.
        </p>

        <!-- Botón CTA -->
        <a href="{{ route('pacientes.index') }}"
           class="inline-block bg-sky-400 hover:bg-sky-500 text-blue-900 font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300">
            Iniciar Aplicación
        </a>

        <!-- Footer -->
        <div class="mt-12 text-sm opacity-70">
            &copy; {{ date('Y') }} Grupo Black - Hackathon
        </div>
    </div>
</body>
</html>
