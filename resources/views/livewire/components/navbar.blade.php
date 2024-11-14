<div>
    <nav class="navbar navbar-expand-lg bg-rdm">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
                aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="/" class="btn btn-orange {{ request()->is('/') ? 'active' : '' }}" wire:navigate >Home</a>
                    </li>

                </ul>
                <div class="d-flex">
                    @guest
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-light mr-1 {{ request()->is('login') ? 'active' : '' }} ">
                            Login</a>
                        <a href="{{ route('register') }}" class="btn btn-light mr-1 {{ request()->is('register') ? 'active' : '' }}">
                            Register</a>
                    </div>

                    @endguest
                    @auth

                    @livewire('components.logout')
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</div>

