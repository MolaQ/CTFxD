<?php

namespace App\Livewire;

use App\Models\Result;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class TasksPage extends Component
{
    use LivewireAlert;
    public $end, $start, $elapsedTime, $durationTime;
    public $task_id, $contestName, $attempts, $title, $description, $answer, $points, $isOpen = false, $isInfo = false;

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isInfo = false;
    }

    public function openInfoModal(Task $task)
    {
        $userId = Auth::user()->id;
        $this->contestName = $task->contest->name;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->start = $task->start_time;
        $this->end = $task->end_time;
        $this->isInfo = true;
        $this->elapsedTime = $task->elapsedTime($task->start_time);
        $this->durationTime = $task->durationTime($task->start_time, $task->end_time);
        $this->points = $task->score($task->start_time, $task->end_time, 1000);
        $this->attempts = Result::where('task_id', $task->id)->where('user_id', $userId)->first();
        if (empty($this->attempts)) {
            $this->attempts = 1;
        } else $this->attempts = $this->attempts->attempts;
    }


    public function scoreModal(Task $task)
    {
        $this->attempts = Result::where('task_id', $task->id)->where('user_id', Auth::user()->id)->first();
        if (empty($this->attempts)) {
            $this->attempts = 10;
        } else $this->attempts = 10 - $this->attempts->attempts;

        $this->isOpen = true;
        $this->points = $task->score($task->start_time, $task->end_time, 1000);
        $this->task_id = $task->id;
    }

    public function scoreAttempt($id)
    {
        $userId = Auth::user()->id;
        $task = Task::findOrFail($id);

        if ($this->answer == null) {
            $this->alert('info', 'Enter your answer!');
            return;
        }

        $now = now();

        if ($task->end_time < $now) {
            $this->alert('error', 'Task time expired!');
            $this->closeModal();
            return;
        }
        //SPRAWDZENIE CZY BYŁA PRÓBA ODPOWIEDZI
        $result = Result::where('task_id', $task->id)->where('user_id', $userId)->first();
        if (empty($result)) $result = new Result([
            'task_id' => $task->id,
            'user_id' => $userId,
            'response' => $this->answer,
            'attempts' => $this->attempts,
            'is_correct' => 0,
            'points' => $task->score($task->start_time, $task->end_time, 1000),


        ]);
        //ZA POMOCĄ FUNKCJI W MODELU RESULT SPRAWDZENIE CZY NIE ZOSTAŁA PRZEKROCZONA ILOŚC PRÓB
        if ($result->hasExceededAttempts()) {
            $this->alert('error', 'You have exceeded the maximum number of attempts for this task.');
            $this->closeModal();
            return;
        } else {
            $check = Result::where('task_id', $task->id)->where('user_id', $userId)->where('is_correct', 1)->first();
            if ($check) {
                $this->alert('info', 'You killed this task earlier!');
                $this->closeModal();
                return;
            }
        }

        $result->incrementAttempts();

        if ($this->answer == $task->solution) {
            $this->alert('success', 'Correct answer!');

            $result->update([
                'response' => $this->answer,
                'is_correct' => 1,
                'points' => $task->score($task->start_time, $task->end_time, 1000),
            ]);
        } else {
            $this->alert('error', 'Incorrect answer. Try again!');
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

        //AKTYWNE ZADANIA AKTYWNYCH KONKURSÓW
        // Filtrowanie po wyszukiwaniu (name, email, school name)
        $tasksQuery->where(function ($subQuery) {
            $subQuery->where('start_time', "<=", now())
                ->where('end_time', ">", now())
                ->whereHas('contest', function ($contestQuery) {
                    $contestQuery->where('start_time', "<=", now())
                        ->where('end_time', ">", now());
                });
        });


        $idsActiveTask = $tasksQuery->pluck('id')->toArray();

        //BEZ PRAWIDŁOWEJ ODPOWIEDZI I DOSTĘPNYMI PRÓBAMI DO ODPOWIEDZI
        $idsTasksWithCorrectResponse = Result::where('user_id', $id)->whereIn('task_id', $idsActiveTask)->where('is_correct', 1)->orWhere('attempts', 10)->pluck('task_id')->toarray();
        $tasksQuery->whereNotIn('id', $idsTasksWithCorrectResponse);


        //TYLKO ZADANIA KTÓRYM POZOSTAŁY JESZCZE JAKIEŚ PRÓBY


        $allTasks = $tasksQuery->paginate(10);;

        return view('livewire.tasks-page', [
            'allTasks' => $allTasks,
        ]);
    }
}
