<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AdminUsersForm extends Form
{
    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|string|max:255')]
    public $email;

    #[Rule('nullable|exists:schools,id')]
    public $school_id;

    #[Rule('nullable|exists:teams,id')]
    public $team_id;

    #[Rule('required|string|min:8|confirmed')]
    public $password;

    #[Rule('required|string|min:8')]
    public $password_confirmation;
}
