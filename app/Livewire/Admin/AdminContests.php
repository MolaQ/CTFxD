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
        $this->reset('form.name', 'contest_id', 'form.description', 'form.start_time', 'form.end_time');
    }

    public function store()
    {
        $this->validate();

        Contest::updateOrCreate(['id' => $this->contest_id], [
            'name' => $this->form->name,
            'description' => $this->form->description,
            'start_time' => $this->form->start_time,
            'end_time' => $this->form->end_time,
        ]);

        session()->flash(
            'success',
            $this->contest_id ? 'Content updated successfully.' : 'Content created Successfully.'
        );

        $this->reset('form.name');
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function modify($id)
    {
        $team = Contest::findOrFail($id);
        $this->contest_id = $id;
        $this->form->name = $team->name;
        $this->form->description = $team->description;
        $this->form->start_time = $team->start_time;
        $this->form->end_time = $team->end_time;

        $this->openModal();
    }
    public function delete($id)
    {
        Contest::find($id)->delete();
        session()->flash('success', 'Contest deleted from database successfully.');

        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }
    public function render()
    {

        $usersQuery = Contest::query();

        // Filtrowanie po wyszukiwaniu (name)
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
