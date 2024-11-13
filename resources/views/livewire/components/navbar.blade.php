<div>

    <nav class="navbar sticky-top navbar-dark" style="background-color: #780000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>

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

    </nav>

</div>
