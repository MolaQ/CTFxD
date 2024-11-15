<?php

namespace App\Livewire\Admin\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'Wylogowanie pomyślne, do zobaczenia później');

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.admin.components.logout');
    }
}