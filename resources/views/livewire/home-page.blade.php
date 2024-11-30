<div>
    <h1>Close your eyes. Count to one. That is how long forever feels.</h1>

    @auth
        Zalogowany!
        @if (Auth::user()->isAdmin())
            <p>Witaj, Administratorze!</p>
            <!-- Kod dla administratora -->
        @else
            <p>Witaj, Użytkowniku!</p>
            <!-- Kod dla zwykłego użytkownika -->
        @endif
    @endauth
    @include('livewire.admin.layouts.components.flash')

</div>
