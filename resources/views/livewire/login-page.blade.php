<div class="container mt-5">
    <h2>Sign in!</h2>
    <div class="justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('login') }}</div>
                <div class="card-body">
                    <form wire:submit.prevent="authenticate">
                        @csrf
                        <div class="form-group">
                            <label for="email">{{ __('email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalide @enderror"
                                id="email" wire:model="email">
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label for="password">{{ __('password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalide @enderror"
                                id="email" wire:model="password">
                                @error('password')
                            
                            <p class="text-danger">{{ $message }}</p>
                              

                            @enderror


                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-secondary mt-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
