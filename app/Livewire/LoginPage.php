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

            if (Auth::user()->is_active) {
                //ZALOGOWANO POMYŚLNIE
                // session()->flash('success', 'zalogowano pomyślnie');
                // $this->dispatch('flashMessage'); // Dispatch zdarzenia
                return redirect()->intended('/'); //PRZEKIEROWANIE DO STRONY GŁÓWNEJ
            } else {
                Auth::logout();
                session()->flash('danger', 'użytkownik nieaktywny');
                $this->dispatch('flashMessage'); // Dispatch zdarzenia
                //return redirect()->intended('/login');
            }
        } else {
            session()->flash('danger', 'Nieprawidłowa nazwa użytkownika lub hasło');
            $this->dispatch('flashMessage'); // Dispatch zdarzenia
        }
    }



    public function render()
    {
        return view('livewire.login-page');
    }
}
