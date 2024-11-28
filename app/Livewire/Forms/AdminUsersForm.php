<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AdminUsersForm extends Form
{
    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|string|max:255')]
    public $email;

    #[Rule('required|integer|max:255')]
    public $school_id;

    //#[Rule('required|string|max:255')]

}
