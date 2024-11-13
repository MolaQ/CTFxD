<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{

    public $email;
    public $password;

    public function authenticate()
    {
        $this->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            //ZALOGOWANO POMYŚLNIE
            session()->flash('success', 'zalogowano pomyślnie');
            return redirect()->intended('/'); //PRZEKIEROWANIE DO STRONY GŁÓWNEJ
        };
    }

    public function render()
    {
        return view('livewire.login-page');
    }
}
