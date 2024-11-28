<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\AdminUsersForm;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;

class AdminUsers extends Component
{

    public AdminUsersForm $form;

    use WithPagination;
    #[Layout('livewire.admin.layouts.app')]

    public $allusers, $user_id, $title = "Users";
    public $isOpen = false;
    public $name, $email, $is_active, $hasSchool, $selectedSchool;
    public $isActive, $school_id, $search = '', $activeOrNot = '', $anySchools = '';


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
        $this->reset('form.name', 'form.email', 'form.school_id');
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
            'school_id' => $this->form->school_id
        ]);

        session()->flash(
            'success',
            $this->user_id ? 'User updated successfully.' : 'User created successfully.'
        );

        $this->reset('form.name', 'form.email', 'form.school_id');
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

        //dd($this->all());

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
        if ($this->isActive) {
            $usersQuery->where('is_active', 0);
        }

        // Filtrowanie po przypisaniu do szkoły
        if ($this->hasSchool) {
            $usersQuery->where('school_id', 1);
        }

        // Paginacja wyników
        $users = $usersQuery->paginate(10);
        $allSchools = School::all();
        return view('livewire.admin.admin-users', [
            'users' => $users,
            'allSchools' => $allSchools,
        ]);
    }
}
