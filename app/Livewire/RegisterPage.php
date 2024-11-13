<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterPage extends Component
{
    #[Validate()]
    public $name = '';
    public $email = '';
    public $password = '';
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'email|required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function registration()
    {

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);
        session()->flash('success', 'konto zostało poprawnie utworzone');

        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.register-page');
    }
}
