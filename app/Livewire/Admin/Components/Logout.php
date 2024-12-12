<?php

namespace App\Livewire\Admin\Components;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Logout extends Component
{
    use LivewireAlert;
    public function logout()
    {
        Auth::logout();
        $this->alert('info', 'Wylogowanie pomyślne, do zobaczenia później');

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.admin.components.logout');
    }
}
