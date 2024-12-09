<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginPage extends Component
{
    use LivewireAlert;

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
                $this->alert('success', 'Welcome', ['timer' => 6000,]);
                return redirect()->intended('/'); //PRZEKIEROWANIE DO STRONY GŁÓWNEJ

            } else {
                Auth::logout();
                $this->alert('error', 'User inactive.', ['timer' => 6000,]);
                //return redirect()->intended('/login');
            }
        } else {
            $this->alert('error', 'Your credentials do not match our records.', ['timer' => 6000,]);
        }
    }



    public function render()
    {
        return view('livewire.login-page');
    }
}
