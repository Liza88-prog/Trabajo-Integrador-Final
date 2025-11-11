<!-- resources/views/layouts/app.blade.php -->
@props(['header'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100">
    <x-banner />

    <div class="min-h-screen flex flex-col">
        <!-- Barra de navegación -->
        @livewire('navigation-menu')

        <!-- Encabezado dinámico -->
        @isset($header)
            <header class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-6 lg:px-8">
                    <h2 class="font-semibold text-2xl text-white leading-tight">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <!-- Contenido principal -->
        <main class="flex-1 py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-2xl p-6">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <!-- Pie de página -->
        <footer class="bg-gray-100 dark:bg-gray-800 text-center text-sm text-gray-600 dark:text-gray-400 py-4 mt-auto">
            <p>© {{ date('Y') }} {{ config('app.name', 'Laravel') }} — Todos los derechos reservados.</p>
        </footer>
    </div>

    @stack('modals')
    @livewireScripts
</body>
</html>
