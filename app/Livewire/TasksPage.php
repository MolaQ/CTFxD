<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksPage extends Component
{
    public $task_id, $title, $description, $answer, $points, $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }


    public function scoreModal(Task $task)
    {
        $this->isOpen = true;
    }

    public function render()
    {

        $allTasks = Task::all();

        return view('livewire.tasks-page', [
            'allTasks' => $allTasks,
        ]);
    }
}
