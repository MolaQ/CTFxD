<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::with(['team', 'school'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user-details');
    }
}
