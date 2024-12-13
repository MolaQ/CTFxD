<div>
    <h1>Knowing others is intelligence; knowing yourself is true wisdom.</h1>

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


</div>
