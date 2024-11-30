<?php

namespace App\Livewire\Admin;

use App\Models\School;
use App\Livewire\Forms\AdminSchoolsForm;
use Livewire\WithPagination;
use Livewire\Component;

class AdminSchools extends Component
{
    use WithPagination;

    public AdminSchoolsForm $form;

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
        $this->reset('form.name', 'form.city', 'school_id');
    }

    public function store()
    {
        $this->validate();

        School::updateOrCreate(['id' => $this->school_id], [
            'name' => $this->form->name,
            'city' => $this->form->city
        ]);

        session()->flash(
            'success',
            $this->school_id ? 'School updated successfully.' : 'School Created Successfully.'
        );

        $this->reset('form.name', 'form.city');
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function modify($id)
    {
        $school = School::findOrFail($id);
        $this->school_id = $id;
        $this->form->name = $school->name;
        $this->form->city = $school->city;

        $this->openModal();
    }

    public function delete($id)
    {

        School::find($id)->delete();
        session()->flash('success', 'School deleted successfully.');
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }
}
