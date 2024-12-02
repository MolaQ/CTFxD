<?php

namespace App\Livewire\Admin;

use App\Models\School;
use App\Livewire\Forms\AdminSchoolsForm;
use App\Models\SchoolCategory;
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

        $allCategories = SchoolCategory::all();
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
            'allCategories' => $allCategories,
        ]);
    }

    public function create()
    {
        $this->openModal();
        $this->reset('form.name', 'form.city', 'school_id', 'form.category_id');
    }

    public function store()
    {
        $this->validate();

        // dd($this->form->all());
        School::updateOrCreate(['id' => $this->school_id], [
            'name' => $this->form->name,
            'city' => $this->form->city,
            'category_id' => $this->form->category_id ?: null,
        ]);

        session()->flash(
            'success',
            $this->school_id ? 'School updated successfully.' : 'School Created Successfully.'
        );

        $this->reset('form.name', 'form.city', 'form.category_id');
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function modify($id)
    {
        $school = School::findOrFail($id);
        $this->school_id = $id;
        $this->form->name = $school->name;
        $this->form->city = $school->city;
        $this->form->category_id = $school->category_id;

        $this->openModal();
    }

    public function delete($id)
    {

        School::find($id)->delete();
        session()->flash('success', 'School deleted successfully.');
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }
}
