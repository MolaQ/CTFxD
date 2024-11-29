<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use Livewire\Component;

class AdminSchools extends Component
{
    use WithPagination;

    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|min:3')]
    public $name;

    #[Rule('required|string|min:3')]
    public $city;

    public $schools, $school_id, $title = "Schools";
    public $isOpen = 0;
    public $search;

    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {

        $usersQuery = School::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $usersQuery->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('city', 'like', '%' . $this->search . '%');
            });
        }

        // Paginacja wyników
        $allschools = $usersQuery->paginate(10);

        return view('livewire.admin.admin-schools', [
            'allschools' => $allschools,
        ]);
    }

    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->city = '';
        $this->school_id = '';
    }

    public function store()
    {
        $this->validate();

        School::updateOrCreate(['id' => $this->school_id], [
            'name' => $this->name,
            'city' => $this->city
        ]);

        session()->flash(
            'success',
            $this->school_id ? 'School updated successfully.' : 'School Created Successfully.'
        );

        $this->resetInputFields();
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function modify($id)
    {
        $school = School::findOrFail($id);
        $this->school_id = $id;
        $this->name = $school->name;
        $this->city = $school->city;

        $this->openModal();
    }

    public function delete($id)
    {

        School::find($id)->delete();
        session()->flash('success', 'School deleted successfully.');
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }
}
