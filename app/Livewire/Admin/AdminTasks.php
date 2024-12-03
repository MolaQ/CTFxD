<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AdminTasksForm;
use App\Models\Contest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage;
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
        $this->reset('form.name', 'task_id', 'form.description', 'form.solution', 'form.image', 'form.start_time', 'form.end_time', 'form.contest_id');
    }

    public function store()
    {
        $this->form->start_time = Carbon::parse($this->form->start_time)->format('Y-m-d H:i:s');
        $this->form->end_time = Carbon::parse($this->form->end_time)->format('Y-m-d H:i:s');
        $this->validate();

$name = $this->form->image->getClientOriginalName();
$path = $this->form->image->storeAs('img/task-images', $name, 'public');

        // Tworzenie zadania
        Task::create([
            'contest_id' => $this->form->contest_id,
            'title' => $this->form->title,
            'description' => $this->form->description,
            'solution' => $this->form->solution,
            'image' => $path,
            'start_time' => $this->form->start_time,
            'end_time' => $this->form->end_time,
        ]);
        //$this->reset('form.title', 'form.description', 'form.image', 'form.start_time', 'form.end_time', 'form.contest_id', );
        $this->closeModal();
        $this->dispatch('flashMessage'); // Dispatch zdarzenia
    }

    public function modify($id)
    {
          $this->form->start_time = Carbon::parse($this->form->start_time)->format('Y-m-d H:i');
        $this->form->end_time = Carbon::parse($this->form->end_time)->format('Y-m-d H:i');
        $task = Task::findOrFail($id);
         $this->task_id = $id;
        $this->form->contest_id = $task->contest_id;
        $this->form->title = $task->title;
        $this->form->description = $task->titdescriptionle;
        $this->form->image = $task->image;
        $this->form->start_time = $task->start_time;
        $this->form->end_time = $task->end_time;

        $this->openModal();
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        // Usuwanie pliku z dysku
        if ($task->image && File::exists(public_path($task->image))) {
            File::delete(public_path($task->image));
        }

        session()->flash('success', 'Team deleted from database successfully.');

        $this->dispatch('flashMessage'); // Dispatch zdarzenia
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
        $allContests = Contest::all();
        return view('livewire.admin.admin-tasks', [
            'allTasks' => $allTasks,
            'allContests' => $allContests,
        ]);
    }
}
