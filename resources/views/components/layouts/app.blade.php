<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    {{-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>

    @livewire('components.navbar')
    <div class="container px-4 py-5">
        {{ $slot }}
    </div>
    @livewire('components.footer')

    {{-- <script src="{{ asset('js/bootstrap.bundle.js') }}"></script> --}}
    @livewireScripts

</body>

</html>
