<?php

namespace App\Livewire;

use App\Models\Contest;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RankPage extends Component
{
    public $search = null, $now, $contest_id;
    public $contest_name = '';
    public $allResults, $selectRank;
    public function mount()
    {
        $this->now = now()->addDays(7); // Ustaw wartość dla $this->now
        Log::info("Ustawiono datę now+7 " . $this->now); // Logowanie do pliku laravel.lo
        $firstContest = Contest::where('end_time', '<=', $this->now)->first();
        $this->contest_id = $firstContest->id ?? null;
        $this->contest_name = $firstContest->name ?? 'Brak dostępnych konkursów';
        $this->selectRank = "individual";
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


        $this->allResults = Result::query();
        $this->allResults->whereIn('task_id', $taskIds);

        // Dodaj wyszukiwanie
        if (!empty($this->search)) {
            $this->allResults->where(function ($q) {
                $q->whereHas('user', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })->orWhereHas('user.team', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('user.school', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                });
            });
        }

        // Załaduj wyniki
        if ($this->selectRank === 'individual') {
            // Ranking indywidualny

            $this->allResults->with('user')
                ->select('user_id', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('user_id')
                ->orderByDesc('total_points');
            //dd($this->allResults->get());
        } elseif ($this->selectRank === 'team') {
            // Ranking zespołowy

            $this->allResults->join('users', 'results.user_id', '=', 'users.id')
                ->join('teams', 'users.team_id', '=', 'teams.id')
                ->select('teams.name as team_name', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('teams.name')
                ->orderByDesc('total_points');
        } elseif ($this->selectRank === 'school') {
            // Ranking szkół
            $this->allResults->join('users', 'results.user_id', '=', 'users.id')
                ->join('schools', 'users.school_id', '=', 'schools.id')
                ->select('schools.name as school_name', DB::raw('SUM(points*is_correct) as total_points'))
                ->groupBy('schools.name')
                ->orderByDesc('total_points');
        }
        $data = $this->allResults;
        $this->allResults = $data->get();
        Log::info("Załadowano wyniki: " . $this->allResults->toJson());
    }

    public function updatedContestId($value)
    {
        Log::info("Wybrano konkurs: " . $value); // Logowanie do pliku laravel.log
        $this->contest_id = $value;
        $this->loadResults();
    }

    public function changeRank($rank)
    {
        $this->selectRank = $rank;
        $this->loadResults();
    }

    public function updatedSearch()
    {
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
