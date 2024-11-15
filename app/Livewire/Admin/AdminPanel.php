<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Foundation\Inspiring;
use Throwable;

class AdminPanel extends Component
{

    #[Layout('livewire.admin.layouts.app')]

    public $title = "Admin panel";

    public function render()
    {




        return view('livewire.admin.admin-panel');
    }
}
