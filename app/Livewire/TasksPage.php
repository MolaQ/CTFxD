<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TasksPage extends Component
{
    public function render()
    {

        // // Przykładowe użycie
        // $t = 600;
        // $t_start = 0;      // Początkowy czas
        // $t_end = 7200;       // Końcowy czas
        // $p_max = 1000;     // Maksymalna wartość P

        // dd(Task::score('08.12.2024 12:00', '15.12.2024 17:00', $p_max));


        $allTasks = Task::all();

        return view('livewire.tasks-page', [
            'allTasks' => $allTasks,
        ]);
    }
}
