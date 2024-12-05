<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AdminTasksForm;
use App\Models\Contest;
use App\Models\Task;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads; // Importujemy trait
use Livewire\Component;

class AdminTasks extends Component
{
    use WithFileUploads; // Używamy traitu

    public AdminTasksForm $form;

    public $isOpen = false,
        $search,
        $tempPath,
        $imagePath,
        $tmpImg,
        $wasUpd = false;
    public $task_id,
        $title = 'Tasks';

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
        $this->tempPath = null; // Reset tymczasowej ścieżki
        $this->tmpImg = false; // Wyłączenie trybu podglądu dla istniejącego obrazu
        $this->openModal();
        $this->reset('form.title', 'task_id', 'form.description', 'form.solution', 'form.image', 'form.start_time', 'form.end_time', 'form.contest_id');
    }

    public function store()
    {
        //AKTUALIZACJA OBRAZU Z OBRAZEM
        if ($this->task_id) {
            $this->validateOnly($this->form->contest_id);
            $this->validateOnly($this->form->title);
            $this->validateOnly($this->form->description);
            $this->validateOnly($this->form->solution);
            $this->validateOnly($this->form->start_time);
            $this->validateOnly($this->form->end_time);

            //ODNALEZIENIE TASKA
            $task = Task::findOrFail($this->task_id);
            //AKTUALIZACJA TASKA
            $task->update([
                'contest_id' => $this->form->contest_id,
                'title' => $this->form->title,
                'description' => $this->form->description,
                'solution' => $this->form->solution,
                'image' => $this->imagePath,
                'start_time' => Carbon::parse($this->form->start_time)->format('Y-m-d H:i:s'),
                'end_time' => Carbon::parse($this->form->end_time)->format('Y-m-d H:i:s'),
            ]);
        }
        //TWORZENIE TASKU Z OBRAZEM
        else {
            $this->validate();
            $this->imagePath = $this->form->image->storeAs('img/task-images', $this->form->image->getClientOriginalName(), 'public');
            Task::create([
                'contest_id' => $this->form->contest_id,
                'title' => $this->form->title,
                'description' => $this->form->description,
                'solution' => $this->form->solution,
                'start_time' => Carbon::parse($this->form->start_time)->format('Y-m-d H:i:s'),
                'end_time' => Carbon::parse($this->form->end_time)->format('Y-m-d H:i:s'),
                'image' => $this->imagePath,
            ]);
        }

        $this->reset('form.title', 'form.description', 'form.image', 'form.start_time', 'form.end_time', 'form.contest_id', 'task_id', 'tempPath');
        $this->closeModal();
        $this->dispatch('flashMessage');
    }

    public function updatedFormImage()
    {
        if ($this->form->image) {
            $this->tempPath = $this->form->image->temporaryUrl(); // Generowanie URL tymczasowego obrazu
        }
        $this->wasUpd = true;
    }

    public function modify($id)
    {
        $task = Task::findOrFail($id);
        $this->task_id = $id;
        $this->form->contest_id = $task->contest_id;
        $this->form->title = $task->title;
        $this->form->description = $task->description;
        $this->form->solution = $task->solution;
        $this->form->image = $task->image;
        $this->form->start_time = Carbon::parse($this->form->start_time)->format('Y-m-d H:i');
        $this->form->end_time = Carbon::parse($this->form->end_time)->format('Y-m-d H:i');
        $this->tempPath = asset('storage/' . $task->image); // URL istniejącego obrazu
        $this->openModal();
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        // Usunięcie pliku, jeśli istnieje
        if ($task->image && File::exists(storage_path('app/public/' . $task->image))) {
            File::delete(storage_path('app/public/' . $task->image));
        }

        // Usunięcie rekordu z bazy danych
        $task->delete();

        session()->flash('success', 'Task deleted successfully.');
        $this->dispatch('flashMessage');
    }

    public function render()
    {
        $tasksQuery = Task::query();
        // Filtrowanie po wyszukiwaniu (name)
        if (!empty($this->search)) {
            $tasksQuery->where(function ($subQuery) {
                $subQuery->where('title', 'like', '%' . $this->search . '%')->orWhere('description', 'like', '%' . $this->search . '%');
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
