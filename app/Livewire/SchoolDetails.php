<?php

namespace App\Livewire;

use App\Models\School;
use Livewire\Component;

class SchoolDetails extends Component
{
    public $school;

    public function mount($id)
    {
        $this->school = School::with('users')->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.school-details');
    }
}
