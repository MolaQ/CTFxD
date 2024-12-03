<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AdminContestsForm extends Form
{
    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|string|max:1000')]
    public $description;

    #[Rule('required|date')]
    public $start_time;

    #[Rule('required|date|after:start_time')]
    public $end_time;
}
