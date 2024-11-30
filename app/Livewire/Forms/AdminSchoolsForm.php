<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

class AdminSchoolsForm extends Form
{

    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|min:3')]
    public $name;

    #[Rule('required|string|min:3')]
    public $city;
}
