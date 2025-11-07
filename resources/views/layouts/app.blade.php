<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CTFxD') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- INTELIGENTNA NAWIGACJA -->
        <livewire:layout.navigation />

        <!-- NAGŁÓWEK STRONY (jeśli jest) -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- GŁÓWNA TREŚĆ STRONY -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- "PRZYKLEJONA" STOPKA -->
        <footer class="bg-ctf-red-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
                <span>MolaQ © {{ date('Y') }}</span>
                <span>Load time: {{ round(microtime(true) - LARAVEL_START, 4) }}s</span>
                <span class="text-xs text-center hidden md:block">"Act only according to that maxim..."</span>
            </div>
        </footer>
    </div>
</body>

</html>
