<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use App\Livewire\Forms\AdminTeamsForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTeams extends Component
{
    use WithPagination;
    use LivewireAlert;

    public AdminTeamsForm $form;



    public $team_id, $title = "Teams";
    public $isOpen = 0;
    public $search = '';

    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->openModal();
        $this->reset('form.name', 'team_id');
    }
    public function store()
    {
        $this->validate();

        Team::updateOrCreate(['id' => $this->team_id], [
            'name' => $this->form->name,
        ]);

        $this->team_id ? $this->alert('success', 'Team updated successfully.', ['timer' => 6000,])
            : $this->alert('success', 'Team created successfully.', ['timer' => 6000,]);

        $this->reset('form.name');
        $this->closeModal();
    }

    public function modify($id)
    {
        $team = Team::findOrFail($id);
        $this->team_id = $id;
        $this->form->name = $team->name;

        $this->openModal();
    }
    public function delete($id)
    {
        Team::find($id)->delete();
        $this->alert('success', 'Team deleted successfully.', ['timer' => 6000,]);
    }

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
