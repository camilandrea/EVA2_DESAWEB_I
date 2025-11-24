<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Evaluación')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Estilos básicos con Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white px-4 py-3 flex justify-between">
        <div class="font-semibold">
            Evaluación – Autenticación
        </div>
        <div class="space-x-3 text-sm">
            <a href="{{ route('login') }}" class="underline">Inicio de sesión</a>
            <a href="{{ route('register') }}" class="underline">Registro</a>
        </div>
    </nav>

    <main class="max-w-md mx-auto mt-8 bg-white shadow-md rounded-lg p-6">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
