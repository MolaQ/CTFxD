<?php

namespace App\Livewire\Admin;

use App\Models\School;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AdminPanel extends Component
{

    #[Layout('livewire.admin.layouts.app')]

    public $title = "Admin panel", $schoolsCounter, $newSchoolsCounter;

    public function render()
    {

        $P_max = 1000; // Maksymalna liczba punktów
        $P_min = 0.001;  // Minimalna liczba punktów
        $startDate = strtotime('2024-12-02 15:50:00'); // Czas rozpoczęcia konkursu
        $now = now(); // Aktualny czas
        $totalDuration = 14 * 24 * 60 * 60; // Czas aktywności zadania w sekundach (14 dni)

        $timeElapsed = strtotime($now) - $startDate;

        // Upewnij się, że czas nie przekracza maksymalnej aktywności zadania
        $timeElapsed = min($timeElapsed, $totalDuration);

        // Obliczenie stałej k
        $k = -log($P_min / $P_max) / $totalDuration;

        // Obliczenie punktów
        $points = $P_max * exp(-$k * $timeElapsed);

        $ile = School::all();
        $this->newSchoolsCounter = $ile->where('created_at', '>=', Carbon::today()->subDays(7))->count();
        $this->schoolsCounter = $ile->count();


        return view('livewire.admin.admin-panel');
    }
}
