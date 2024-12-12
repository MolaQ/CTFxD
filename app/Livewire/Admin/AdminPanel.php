<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminPanel extends Component
{

    #[Layout('livewire.admin.layouts.app')]

    public $title = "Admin panel", $schoolsCounter, $newSchoolsCounter;

    public function render()
    {

        $ile = School::all();
        $this->newSchoolsCounter = $ile->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $this->schoolsCounter = $ile->count();


        return view('livewire.admin.admin-panel');
    }
}
