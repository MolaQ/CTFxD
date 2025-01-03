<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\AdminUsersForm;
use App\Models\School;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AdminUsers extends Component
{

    public AdminUsersForm $form;

    use WithPagination;
    use LivewireAlert;

    public $allusers, $user_id, $title = "Users";
    public $isOpen = false, $isSetPass = false;
    public $name, $email, $password, $password_confirmation, $is_active, $verified, $unVerified;
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

        $this->is_active ? $this->alert('success', 'User activated.', ['timer' => 6000,])
            : $this->alert('success', 'Team deactivated successfully.', ['timer' => 6000,]);
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'school_id' => $user->school_id,
            'team_id' => $user->team_id,
            'is_admin' => $user->is_admin,
            'is_active' => $user->is_active,
            'verified' => !$user->verified,
        ]);
        $user = User::findOrFail($id);
        $this->verified = $user->verified;

        $this->verified ? $this->alert('success', 'User verified.', ['timer' => 6000,])
            : $this->alert('success', 'User not verified.', ['timer' => 6000,]);
    }

    public function create()
    {

        $this->openModal();
        // $this->resetInputFields();
        $this->reset('user_id', 'form.name', 'form.email', 'form.school_id', 'form.team_id', 'form.password', 'form.password_confirmation');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        $this->alert('success', 'User deleted successfully.', ['timer' => 6000,]);
    }

    public function store()
    {

        $this->validate();

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->form->name,
            'email' => $this->form->email,
            'password' => $this->user_id ? $this->form->password : Hash::make($this->form->password),
            'school_id' => $this->form->school_id ?: null,
            'team_id' => $this->form->team_id ?: null,
        ]);

        $this->user_id ? $this->alert('success', 'User updated successfully.', [
            'timer' => 6000,
        ]) : $this->alert('success', 'User created successfully.');

        $this->reset('form.name', 'form.email', 'form.school_id', 'form.team_id', 'form.password', 'form.password_confirmation');
        $this->closeModal();
    }

    public function setPass($id)
    {

        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->openPassModal();
    }


    public function modify($id)
    {

        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->form->name = $user->name;
        $this->form->email = $user->email;
        $this->form->password = $user->password;
        $this->form->password_confirmation = $user->password;
        $this->form->school_id = $user->school_id;
        $this->form->team_id = $user->team_id;

        //dd($this->all());

        $this->openModal();
    }

    public function openPassModal()
    {
        $this->reset('password', 'password_confirmation');
        $this->isSetPass = true;
    }
    public function closePassModal()
    {
        $this->isSetPass = false;
    }

    public function setNewPass()
    {
        $this->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            // 'name' => $this->name,
            // 'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $this->alert('success', 'Password changed.', ['timer' => 6000,]);
        $this->reset('form.name', 'form.email', 'form.school_id', 'form.team_id', 'form.password', 'form.password_confirmation');
        $this->closePassModal();
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
        if ($this->unVerified) {
            $usersQuery->where('verified', 0);
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
