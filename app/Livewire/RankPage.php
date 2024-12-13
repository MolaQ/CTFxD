<?php

namespace App\Livewire;

use App\Models\Contest;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RankPage extends Component
{
    public $search = '', $now, $contest_id;
    public $contest_name = '';
    public $allResults;

    public function mount()
    {
        $this->now = now()->addDays(7); // Ustaw wartość dla $this->now
        Log::info("Ustawiono datę now+7 " . $this->now); // Logowanie do pliku laravel.lo
        $firstContest = Contest::where('end_time', '<=', $this->now)->first();
        $this->contest_id = $firstContest->id ?? null;
        $this->contest_name = $firstContest->name ?? 'Brak dostępnych konkursów';
        Log::info("Ustawiono wartości w mount " . $this->contest_name); // Logowanie do pliku laravel.log
        $this->loadResults();
    }

    public function loadResults()
    {
        Log::info("Ładowanie wyników dla konkursu ID: " . $this->contest_id);
        if (!$this->contest_id) {
            $this->allResults = collect(); // Jeśli brak konkursu, ustaw pustą kolekcję
            Log::info("Brak wyników, ponieważ contest_id jest null.");
            return;
        }

        // Pobierz identyfikatory zadań przypisanych do konkursu
        $taskIds = Contest::find($this->contest_id)?->tasks()->pluck('id')->toArray() ?? [];
        Log::info("Pobrano zadania dla konkursu: " . implode(", ", $taskIds));

        $this->contest_name = Contest::find($this->contest_id)?->name ?? 'Brak dostępnych konkursów';

        // Załaduj wyniki
        $this->allResults = Result::whereIn('task_id', $taskIds)
            ->select('user_id', DB::raw('SUM(points*is_correct) as total_points'))
            ->groupBy('user_id')
            ->with('user') // Pobierz dane użytkowników
            ->orderByDesc('total_points')
            ->get();
        Log::info("Załadowano wyniki: " . $this->allResults->toJson());
    }

    public function updatedContestId($value)
    {
        Log::info("Wybrano konkurs: " . $value); // Logowanie do pliku laravel.log
        $this->contest_id = $value;
        $this->loadResults();
    }
    public function render()
    {
        $allContests = Contest::where('end_time', '>', $this->now)->orWhere('end_time', '<=', $this->now)->get();

        return view('livewire.rank-page', [
            'allContests' => $allContests,
            'allResults' => $this->allResults,
        ]);
    }
}
