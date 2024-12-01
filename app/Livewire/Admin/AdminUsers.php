<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\AdminUsersForm;
use App\Models\School;
use App\Models\Team;

class AdminUsers extends Component
{

    public AdminUsersForm $form;

    use WithPagination;

    public $allusers, $user_id, $title = "Users";
    public $isOpen = false;
    public $name, $email, $is_active;
    public $noSchool, $noTeam, $inactive, $search = '';


    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function changeState($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'school_id' => $user->school_id,
            'team_id' => $user->team_id,
            'is_admin' => $user->is_admin,
            'is_active' => !$user->is_active,
        ]);
        $user = User::findOrFail($id);
        $this->is_active = $user->is_active;
        session()->flash(
            'success',
            $this->is_active ? 'User activated.' : 'User deactivated successfully'
        );
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function create()
    {
        $this->openModal();
        // $this->resetInputFields();
        $this->reset('form.name', 'form.email', 'form.school_id', 'form.team_id');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('success', 'User removed from database successfully.');

        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function store()
    {

        $this->validate();

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->form->name,
            'email' => $this->form->email,
            'school_id' => $this->form->school_id ?: null,
            'team_id' => $this->form->team_id ?: null,
        ]);

        session()->flash(
            'success',
            $this->user_id ? 'User updated successfully.' : 'User created successfully.'
        );

        $this->reset('form.name', 'form.email', 'form.school_id', 'form.team_id');
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }


    public function modify($id)
    {

        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->school_id = $user->school_id;
        $this->form->team_id = $user->team_id;

        // dd($this->all());

        $this->openModal();
    }

    public function render()
    {
        $usersQuery = User::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $usersQuery->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhereHas('school', function ($schoolQuery) {
                        $schoolQuery->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('city', 'like', '%' . $this->search . '%');
                    });
            });
        }

        // Filtrowanie po aktywności
        if ($this->inactive) {
            $usersQuery->where('is_active', 0);
        }

        // Filtrowanie po przypisaniu do szkoły
        if ($this->noSchool) {
            $usersQuery->where('school_id', null);
        }
        // Filtrowanie po przypisaniu do szkoły
        if ($this->noTeam) {
            $usersQuery->where('team_id', null);
        }

        // Paginacja wyników
        $users = $usersQuery->paginate(10);
        $allSchools = School::all();
        $allTeams = Team::all();
        return view('livewire.admin.admin-users', [
            'users' => $users,
            'allSchools' => $allSchools,
            'allTeams' => $allTeams,
        ]);
    }
}
