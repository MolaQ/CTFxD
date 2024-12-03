<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AdminTasksForm;
use App\Models\Task;

use Livewire\WithFileUploads; // Importujemy trait
use Livewire\Component;

class AdminTasks extends Component
{
    use WithFileUploads; // Używamy traitu

    public AdminTasksForm $form;

    public $isOpen = false, $search;
    public $task_id, $title = "Tasks";

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
        $this->reset('form.name', 'task_id');
    }

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->form->image) {
            $imagePath = $this->form->image->store('task-images', 'public');
        }
    }


    public function render()
    {

        $tasksQuery = Task::query();
        // Filtrowanie po wyszukiwaniu (name)
        if (!empty($this->search)) {
            $tasksQuery->where(function ($subQuery) {
                $subQuery->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Paginacja wyników
        $allTasks = $tasksQuery->paginate(10);
        return view('livewire.admin.admin-tasks', [
            'allTasks' => $allTasks,
        ]);
    }
}
