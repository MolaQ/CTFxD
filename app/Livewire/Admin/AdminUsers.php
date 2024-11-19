<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUsers extends Component
{
    public $isOpen = false;

    use WithPagination;
    #[Layout('livewire.admin.layouts.app')]
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.admin.admin-users', [
            'users' => $users,
        ]);
    }
}
