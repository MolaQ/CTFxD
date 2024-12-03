<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Form;

class AdminTasksForm extends Form
{
    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|exists:contests,id')]
    public $contest_id;

    #[Rule('required|string|min:3')]
    public $title;

    #[Rule('required|string|min:3')]
    public $description;

    #[Rule('required')]
    public $solution;

    #[Rule('required|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image;

    #[Rule('required|date')]
    public $start_time;

    #[Rule('required|date|after:start_time')]
    public $end_time;
}
