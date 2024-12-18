<?php

namespace App\Livewire;

use App\Models\Team;
use Livewire\Component;

class TeamDetails extends Component
{
    public $team;

    public function mount($id)
    {
        $this->team = Team::with('users')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.team-details');
    }
}
