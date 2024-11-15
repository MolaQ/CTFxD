<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdminPanel extends Component
{
    #[Title('Admin panel')]

    #[Layout('livewire.admin.layouts.app')]
    public function render()
    {
        return view('livewire.admin.admin-panel');
    }
}
