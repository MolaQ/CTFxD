<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Login extends Component
{
    public LoginForm $form;

    // ---- POCZĄTEK ZMIAN ----

    /**
     * Definiujemy reguły walidacji dla pól w obiekcie $form
     */
    public function rules()
    {
        return [
            'form.email' => ['required', 'email'],
            'form.password' => ['required'],
        ];
    }

    // ---- KONIEC ZMIAN ----

    public function login(): void
    {
        // Teraz ta metoda będzie wiedziała, jakich reguł użyć
        $this->validate();

        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
