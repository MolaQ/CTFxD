<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AdminContestsForm;
use App\Models\Contest;
use Livewire\Component;

class AdminContests extends Component
{
    public AdminContestsForm $form;

    public $isOpen = false, $search;
    public $contest_id, $title = "Contests";

    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->openModal();
        $this->reset('form.name', 'contest_id');
    }



    public function render()
    {

        $usersQuery = Contest::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $usersQuery->where('name', 'like', '%' . $this->search . '%');
        }
        // Paginacja wyników
        $allContests = $usersQuery->paginate(10);
        return view('livewire.admin.admin-contests', [
            'allContests' => $allContests,
        ]);
        return view('livewire.admin.admin-contests');
    }
}
