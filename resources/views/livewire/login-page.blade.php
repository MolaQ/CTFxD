<div class="col-md-6 offset-md-3">
    <div class="card">

        <div class="card-header bg-rdm text-white">
            <h2>{{ __('Sign in!') }}</h2>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="authenticate">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalide @enderror" id="email"
                        wire:model="email">
                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <label for="password">{{ __('password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalide @enderror" id="email"
                        wire:model="password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror


                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn bg-rdm btn-lg text-white mt-5">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
