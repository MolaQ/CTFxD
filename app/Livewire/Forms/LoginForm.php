<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use App\Models\User;

class LoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * Zmodyfikowana metoda uwierzytelniania.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // 1. Znajdź użytkownika po emailu
        $user = User::where('email', $this->email)->first();

        // 2. Sprawdź, czy użytkownik istnieje i czy hasło jest poprawne
        if (! $user || ! Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.email' => trans('auth.failed'),
            ]);
        }

        // 3. (NOWOŚĆ) Sprawdź, czy konto jest aktywne
        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'form.email' => 'Twoje konto jest nieaktywne. Poczekaj na akceptację administratora.',
            ]);
        }

        // 4. Jeśli wszystko się zgadza - zaloguj użytkownika
        Auth::login($user, $this->remember);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the authentication request is not rate-limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate-limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
