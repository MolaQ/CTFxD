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
    public $search = '';

    public function render()
    {
        $usersQuery = Team::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $usersQuery->where('name', 'like', '%' . $this->search . '%');
        }

        // Paginacja wyników
        $allTeams = $usersQuery->paginate(10);
        return view('livewire.admin.admin-teams', [
            'allTeams' => $allTeams,
        ]);
    }
}
