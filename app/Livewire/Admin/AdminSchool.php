<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

use Livewire\WithPagination;
use Livewire\Component;

class AdminSchool extends Component
{
    use WithPagination;
    #[Layout('livewire.admin.layouts.app')]

    #[Rule('required|string|min:3')]
    public $name;

    #[Rule('required|string|min:3')]
    public $city;

    public $schools, $school_id;

    public $isOpen = 0;

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
        $this->schools = School::all();
        //$this->schools = School::paginate(5);
        return view('livewire.admin.school');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->openModal();
        $this->resetInputFields();
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->city = '';
        $this->school_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        $school = School::find($id);
        $ile = $school->users()->count();
        if ($ile == 0) {
            School::find($id)->delete();
            session()->flash('success', 'School deleted successfully.');
        } else {
            session()->flash('danger', 'School has users. Deleted unsuccessfully.');
        }
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }
}
