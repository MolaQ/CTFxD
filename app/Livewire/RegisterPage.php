<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterPage extends Component
{
    use LivewireAlert;
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
            'school_id' => null,
            'is_active' => 0,
            'verified' => 0,
        ]);

        //Auth::login($user);
        session()->flash('success', 'konto zostało poprawnie utworzone');

        return redirect()->intended('/');
    }

    public function render()
    {
        return view('livewire.register-page');
    }
}
