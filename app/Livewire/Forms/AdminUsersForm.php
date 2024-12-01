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

    #[Rule('nullable|integer')]
    public $school_id;

    #[Rule('nullable|integer')]
    public $team_id;

}
