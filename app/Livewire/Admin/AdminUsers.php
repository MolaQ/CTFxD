<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\AdminUsersForm;

class AdminUsers extends Component
{

    public AdminUsersForm $form;

    use WithPagination;
    #[Layout('livewire.admin.layouts.app')]

    public $allusers, $user_id, $title = "Users";
    public $isOpen = false;
    public $name, $email, $is_active;


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
        $user = User::where('id', $id)->update([
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
            $this->is_active ? 'User activated.' : 'User disactivated'
        );
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function create()
    {
        $this->openModal();
        // $this->resetInputFields();
        $this->reset('form.name', 'form.email');
    }

    public function store()
    {
        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->form->name,
            'email' => $this->form->email
        ]);

        session()->flash(
            'success',
            $this->user_id ? 'User updated successfully.' : 'User created successfully.'
        );

        $this->reset('form.name', 'form.email');
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }


    public function modify($id)
    {;
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->form->name = $user->name;
        $this->form->email = $user->email;

        //dd($this->all());

        $this->openModal();
    }



    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.admin.admin-users', [
            'users' => $users,
        ]);
    }
}
