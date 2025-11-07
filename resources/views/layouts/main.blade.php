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
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{-- Używamy Flexbox, aby "przykleić" stopkę do dołu --}}
    <div class="flex flex-col min-h-screen bg-gray-100">

        <!-- =================================== -->
        <!-- INTELIGENTNA, UNIWERSALNA NAWIGACJA -->
        <!-- =================================== -->
        <header x-data="{ open: false }" class="bg-ctf-red-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Lewa strona: Logo i linki publiczne -->
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-2xl font-bold">CTFxD</a>
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('home') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-ctf-red-800 {{ request()->routeIs('home') ? 'bg-ctf-red-800' : '' }}">Home</a>
                            <a href="{{ route('rank') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-ctf-red-800 {{ request()->routeIs('rank') ? 'bg-ctf-red-800' : '' }}">Rank</a>
                            <a href="{{ route('faq') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-ctf-red-800 {{ request()->routeIs('faq') ? 'bg-ctf-red-800' : '' }}">FAQ</a>
                        </div>
                    </div>

                    <!-- Prawa strona: Dynamiczna zawartość (Gość vs Zalogowany) -->
                    <div class="hidden md:flex items-center space-x-4">
                        @guest
                            {{-- Widok dla GOŚCI --}}
                            <input type="text" placeholder="Szukaj..."
                                class="px-3 py-1.5 text-sm bg-ctf-red-800 border border-ctf-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-white text-white placeholder-gray-300">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 rounded-md text-sm font-medium bg-white text-ctf-red-900 hover:bg-gray-200">Login</a>
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-md text-sm font-medium bg-gray-200 text-ctf-red-900 hover:bg-gray-300">Register</a>
                        @endguest

                        @auth
                            {{-- Widok dla ZALOGOWANYCH --}}
                            <a href="{{ route('dashboard') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium hover:bg-ctf-red-800 {{ request()->routeIs('dashboard') ? 'bg-ctf-red-800' : '' }}">Panel</a>
                            @can('admin')
                                <a href="{{ route('admin.panel') }}"
                                    class="px-3 py-2 rounded-md text-sm font-medium hover:bg-ctf-red-800 {{ request()->routeIs('admin.*') ? 'bg-ctf-red-800' : '' }}">Admin</a>
                            @endcan

                            <!-- Dropdown z profilem i wylogowaniem -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-ctf-red-900 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1"><svg class="fill-current h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg></div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <!-- Wylogowanie -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Główna treść strony (rośnie, aby wypełnić przestrzeń) -->
        <main class="flex-grow">
            {{-- Dodajemy slot na nagłówek strony (np. "Dashboard") --}}
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Główna treść renderowana przez komponenty Livewire --}}
            {{ $slot }}
        </main>

        <!-- =================================== -->
        <!-- "PRZYKLEJONA" STOPKA -->
        <!-- =================================== -->
        <footer class="bg-ctf-red-900 text-white py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
                <span>MolaQ © {{ date('Y') }}</span>
                <span>Load time: {{ round(microtime(true) - LARAVEL_START, 4) }}s</span>
                <span class="text-xs text-center hidden md:block">"Act only according to that maxim whereby you can, at
                    the same time, will that it should become a universal law." - Immanuel Kant</span>
            </div>
        </footer>
    </div>
    @livewireScripts
</body>

</html>
