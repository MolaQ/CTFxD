<div class="container my-1">
    <div class="justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-rdm text-white">
                    <h2>{{ __('Join the game!') }}</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="registration">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalide @enderror"
                                id="name" wire:model="name">
                            @error('name')
                                <span clan="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalide @enderror"
                                id="email" wire:model="email">
                            @error('email')
                                <span clan="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalide @enderror"
                                id="email" wire:model="password">
                            @error('password')
                                <span clan="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ __('password confirmation') }}</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalide @enderror"
                                id="email" wire:model="password_confirmation" name="password">
                            @error('password_confirmation')
                                <span clan="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn bg-rdm text-white btn-lg mt-5">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
