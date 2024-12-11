<?php

namespace App\Livewire;

use App\Models\Result;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TasksPage extends Component
{
    public $end, $start, $elapsedTime, $durationTime;
    public $task_id, $contestName, $title, $description, $answer, $points, $isOpen = false, $isInfo = false;

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isInfo = false;
    }

    public function openInfoModal(Task $task)
    {
        $this->contestName = $task->contest->name;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->start = $task->start_time;
        $this->end = $task->end_time;
        $this->isInfo = true;
        $this->elapsedTime = $task->elapsedTime($task->start_time);
        $this->durationTime = $task->durationTime($task->start_time, $task->end_time);
        //dd($t);
    }


    public function scoreModal(Task $task)
    {
        $this->isOpen = true;
    }

    public function render()
    {
        $now = now();
        $id = Auth::user()->id;


        $tasksQuery = Task::query();


        //DLA ZALOGOWANEGO UŻYTKOWNIKA

        //ZADANIA ROZPOCZĘTE I NIE ZAKOŃCZONE
        $tasksQuery->where('start_time', "<=", $now);
        $tasksQuery->where('end_time', ">", $now);
        $idsActiveTask = $tasksQuery->pluck('id')->toArray();

        //BEZ PRAWIDŁOWEJ ODPOWIEDZI
        $idsTasksWithCorrectResponse = Result::where('user_id', $id)->whereIn('task_id', $idsActiveTask)->where('is_correct', 1)->pluck('task_id')->toarray();
        $tasksQuery->whereNotIn('id', $idsTasksWithCorrectResponse);

        $allTasks = $tasksQuery->paginate(10);

        return view('livewire.tasks-page', [
            'allTasks' => $allTasks,
        ]);
    }
}
