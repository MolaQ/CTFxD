<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Team;
use App\Models\School;
use Livewire\Component;

class SearchResults extends Component
{
    public $query = '';
    public $users = [];
    public $teams = [];
    public $schools = [];

    public function updatedQuery()
    {
        $this->search();
    }

    public function search()
    {
        // Jeśli zapytanie jest puste, wyczyść wyniki
        if (empty($this->query)) {
            $this->users = [];
            $this->teams = [];
            $this->schools = [];
            return;
        }

        // Wyszukaj użytkowników
        $this->users = User::where('name', 'like', '%' . $this->query . '%')
            ->orWhere('email', 'like', '%' . $this->query . '%')
            ->take(5) // Ogranicz wyniki
            ->get();

        // Wyszukaj zespoły
        $this->teams = Team::where('name', 'like', '%' . $this->query . '%')
            ->take(5)
            ->get();

        // Wyszukaj szkoły
        $this->schools = School::where('name', 'like', '%' . $this->query . '%')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.search-results');
    }
}
