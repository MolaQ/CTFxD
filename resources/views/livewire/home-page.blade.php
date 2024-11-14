<div>
    <h1>Close your eyes. Count to one. That is how long forever feels.</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-rdm" data-bs-toggle="modal" data-bs-target="#exampleModal">
        MY CUSTOM COLOR
    </button>

    <div class="alert alert-primary" role="alert">
        A simple primary alert—check it out!
    </div>
    <div class="alert bg-rdm text-white" role="alert">
        A simple secondary alert—check it out!
    </div>
    <div class="alert alert-success" role="alert">
        A simple success alert—check it out!
    </div>
    <div class="alert alert-danger" role="alert">
        A simple danger alert—check it out!
    </div>
    <div class="alert alert-warning" role="alert">
        A simple warning alert—check it out!
    </div>
    <div class="alert alert-info" role="alert">
        A simple info alert—check it out!
    </div>
    <div class="alert alert-light" role="alert">
        A simple light alert—check it out!
    </div>
    <div class="alert alert-dark" role="alert">
        A simple dark alert—check it out!
    </div>
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
