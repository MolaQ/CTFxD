<?php

namespace App\Livewire;

use App\Models\Contest;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class RankPage extends Component
{
    public $search = '';
    public $contest_id;
    public $selectRank = 'individual'; // Domyślny typ rankingu

    /**
     * Uruchamiane przy inicjalizacji komponentu
     */
    public function mount()
    {
        // Znajdź pierwszy zakończony lub trwający konkurs jako domyślny
        $firstContest = Contest::where('end_time', '<=', now()->addDays(7))->orderBy('end_time', 'desc')->first();
        if ($firstContest) {
            $this->contest_id = $firstContest->id;
        } else {
            // Jeśli nie ma żadnych konkursów, spróbuj znaleźć jakikolwiek
            $this->contest_id = Contest::first()->id ?? null;
        }
    }

    /**
     * Metoda renderująca, która jest sercem komponentu.
     * Wykorzystujemy computed properties, aby uprościć kod.
     */
    public function render()
    {
        // Pobieramy wszystkie konkursy do dropdowna
        $allContests = Contest::orderBy('name')->get();

        // Pobieramy wyniki dla wybranego konkursu i typu rankingu
        $results = $this->loadResults();

        return view('livewire.rank-page', [
            'allContests' => $allContests,
            'allResults' => $results,
        ]);
    }

    /**
     * Główna metoda do ładowania i przetwarzania wyników.
     */
    private function loadResults()
    {
        if (!$this->contest_id) {
            return collect(); // Zwróć pustą kolekcję, jeśli nie wybrano konkursu
        }

        $taskIds = Contest::find($this->contest_id)?->tasks()->pluck('id')->toArray() ?? [];

        $query = Result::query()->whereIn('task_id', $taskIds);

        // Budowanie zapytania w zależności od typu rankingu
        if ($this->selectRank === 'individual') {
            $query->with('user.school', 'user.team')
                ->select('user_id', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('user_id')
                ->orderByDesc('total_points');
        } elseif ($this->selectRank === 'team') {
            $query->join('users', 'results.user_id', '=', 'users.id')
                ->join('teams', 'users.team_id', '=', 'teams.id')
                ->select('teams.name as team_name', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('teams.name')
                ->orderByDesc('total_points');
        } elseif ($this->selectRank === 'school') {
            $query->join('users', 'results.user_id', '=', 'users.id')
                ->join('schools', 'users.school_id', '=', 'schools.id')
                ->select('schools.name as school_name', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('schools.name')
                ->orderByDesc('total_points');
        }

        $results = $query->get();

        // Dodawanie pozycji w rankingu
        $rankedResults = $results->map(function ($item, $index) {
            $item->rank = $index + 1;
            return $item;
        });

        // Filtrowanie po stronie serwera (w kolekcji)
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            return $rankedResults->filter(function ($item) use ($search) {
                if ($this->selectRank === 'individual') {
                    return str_contains(strtolower($item->user->name ?? ''), $search) ||
                        str_contains(strtolower($item->user->email ?? ''), $search);
                }
                if ($this->selectRank === 'team') {
                    return str_contains(strtolower($item->team_name ?? ''), $search);
                }
                if ($this->selectRank === 'school') {
                    return str_contains(strtolower($item->school_name ?? ''), $search);
                }
                return false;
            });
        }

        return $rankedResults;
    }
}
