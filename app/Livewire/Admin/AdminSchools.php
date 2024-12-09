<?php

namespace App\Livewire\Admin;

use App\Models\School;
use App\Livewire\Forms\AdminSchoolsForm;
use App\Models\SchoolCategory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;

class AdminSchools extends Component
{
    use WithPagination;
    use LivewireAlert;
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
        $schoolsQuery = School::query();

        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $schoolsQuery->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('city', 'like', '%' . $this->search . '%');
            });
        }

        // Paginacja wyników
        $allschools = $schoolsQuery->paginate(10);

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

        $this->school_id ? $this->alert('success', 'School updated successfully.', ['timer' => 6000,])
            : $this->alert('success', 'School created successfully.', ['timer' => 6000,]);

        $this->reset('form.name', 'form.city', 'form.category_id');
        $this->closeModal();
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
        $this->alert('success', 'School deleted successfully.', ['timer' => 6000,]);
    }
}
