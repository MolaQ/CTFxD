<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTeams extends Component
{
    use WithPagination;

    #[Layout('livewire.admin.layouts.app')]

    public $teams, $team_id, $title = "Teams";
    public $isOpen = 0;

    public function render()
    {
        $allTeams = Team::all();
        return view('livewire.admin.admin-teams', [
            'allTeams' => $allTeams,
        ]);
    }
}
