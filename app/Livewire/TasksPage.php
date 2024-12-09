<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksPage extends Component
{
    public function render()
    {
        $allTasks = Task::all();

        return view('livewire.tasks-page', [
            'allTasks' => $allTasks,
        ]);
    }
}
