<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use App\Livewire\Forms\AdminTeamsForm;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTeams extends Component
{
    use WithPagination;
    use LivewireAlert;

    public AdminTeamsForm $form;



    public $team_id, $title = "Teams";
    public $isOpen = 0, $addManager = 0, $teamId, $searchManagers;
    public $search = '';

    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->addManager = false;
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

    public function openAddManager(Team $team)
    {
        $this->reset('searchManagers');
        $this->teamId = $team->id;

        $this->addManager = 1;
    }

    public function addTeamManager($id)
    {
        $team = Team::findOrFail($this->teamId);
        $team->update(['manager_id' => $id]);

        $this->closeModal();
        $this->alert('success', 'Manager appointed.', ['timer' => 6000,]);
        $this->reset('teamId');
    }

    public function removeTeamManager(Team $team, $id)
    {
        $team->update(['manager_id' => null]);
        $this->alert('success', 'Manager fired.', ['timer' => 6000,]);
    }

    public function render()
    {
        $managersQuery = User::query();


        if (!empty($this->searchManagers)) {
            $managersQuery->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->searchManagers . '%')
                    ->orWhere('email', 'like', '%' . $this->searchManagers . '%');
            });
        }
        $allManagers = $managersQuery->paginate(10);





        $usersQuery = Team::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $usersQuery->where('name', 'like', '%' . $this->search . '%');
        }

        // Paginacja wyników
        $allTeams = $usersQuery->paginate(10);
        return view('livewire.admin.admin-teams', [
            'allTeams' => $allTeams,
            'allManagers' => $allManagers,
        ]);
    }
}
