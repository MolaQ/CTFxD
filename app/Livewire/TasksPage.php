<?php

namespace App\Livewire;

use App\Models\Result;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TasksPage extends Component
{
    use LivewireAlert;
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
        $this->points = $task->score($task->start_time, $task->end_time, 1000);
    }


    public function scoreModal(Task $task)
    {
        $this->isOpen = true;
        $this->task_id = $task->id;
    }

    public function scoreAttempt($id)
    {
        $userId = Auth::user()->id;
        $task = Task::findOrFail($id);
        $now = now();

        if ($task->end_time < $now) {
            $this->alert('error', 'Task time expired!');
            $this->closeModal();
        } else {
            $check = Result::where('task_id', $task->id)->where('user_id', $userId)->where('is_correct', 1)->first();
            if ($check) {
                $this->alert('info', 'You killed this task earlier!');
                $this->closeModal();
            } {
                if ($this->answer == $task->solution) {
                    $this->alert('success', 'Yep. Thats right');
                    Result::updateOrCreate(['task_id' => $task->id, 'user_id' => $userId], [
                        'task_id' => $task->id,
                        'user_id' => $userId,
                        'response' => $this->answer,
                        'is_correct' => 1,
                        'points' => $task->score($task->start_time, $task->end_time, 1000),
                    ]);
                } else {
                    $this->alert('error', 'You missed!');
                    Result::updateOrCreate(['task_id' => $task->id, 'user_id' => $userId], [
                        'task_id' => $task->id,
                        'user_id' => $userId,
                        'response' => $this->answer,
                        'is_corect' => 0,
                        'points' => $task->score($task->start_time, $task->end_time, 1000),
                    ]);
                };
            }
        }




        $this->closeModal();
        $this->reset('answer');
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
