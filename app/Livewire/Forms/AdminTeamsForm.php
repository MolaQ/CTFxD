<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AdminTeamsForm extends Form
{
    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|min:3')]
    public $name;
}
