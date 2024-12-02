<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminTasks extends Component
{
    #[Layout('livewire.admin.layouts.app')]
    public function render()
    {
        return view('livewire.admin.admin-tasks');
    }
}