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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('flashMessage', function() {
                setTimeout(function() {
                    let flashMessages = document.querySelectorAll('.flash-message');
                    flashMessages.forEach(function(flashMessage) {
                        flashMessage.style.transition = 'opacity 0.5s ease';
                        flashMessage.style.opacity = '0';
                        setTimeout(function() {
                            flashMessage.remove();
                        }, 500); // Czas na zakończenie animacji
                    });
                }, 3000); // 3000 ms = 3 sekundy
            });
        });
    </script>
</body>

</html>
