<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'CTFxD' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="flex flex-col min-h-screen bg-white text-black">
    <div class="flex flex-1 flex-col md:flex-row">
        <!-- Sidebar -->
        <aside class="bg-[#880000] text-white w-full md:w-64 min-h-[60px] md:min-h-screen p-4 md:p-6 flex flex-row md:flex-col items-center md:items-start justify-between md:justify-start">
            <h2 class="text-2xl font-bold mb-4 md:mb-8">CTFxD Dashboard</h2>
            <nav class="flex md:flex-col space-x-4 md:space-x-0 md:space-y-4 w-full md:w-auto">
                <a href="{{ route('admin.panel') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Panel główny</a>
                <a href="{{ route('admin.schools') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Szkoły</a>
                <a href="{{ route('admin.teams') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Drużyny</a>
                <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Użytkownicy</a>
                <a href="{{ route('admin.tasks') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Zadania</a>
                <a href="{{ route('admin.contests') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Konkursy</a>
                <a href="{{ route('admin.faqs') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Faq</a>
                <a href="{{ route('logout') }}" class="block px-3 py-2 rounded hover:bg-red-900 transition text-center md:text-left w-full md:w-auto">Wyloguj</a>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 min-h-screen">
            <!-- Header -->
            <header class="bg-white border-b border-gray-300 p-4 flex justify-between items-center shadow">
                <h1 class="text-xl font-semibold text-black">{{ $title ?? 'Admin panel' }}</h1>
                <div class="text-sm text-gray-600">Użytkownik: {{ auth()->user()->name ?? 'Admin' }}</div>
            </header>

            <!-- Main content -->
            <main class="flex-1 overflow-auto p-6 md:p-8 bg-gray-50">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-300 p-4 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Twoja Firma. Wszelkie prawa zastrzeżone.
            </footer>
        </div>
    </div>

    @livewireScripts
</body>
</html>
