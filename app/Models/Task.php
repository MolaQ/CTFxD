<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['contest_id', 'title', 'description', 'solution', 'image', 'start_time', 'end_time'];

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function isImageUsedByOtherTasks()
    {
        return Task::where('image', $this->image)->where('id', '!=', $this->id)->exists();
    }

    public static function color($start, $end)
    {
        $today = now();
        if ($today < $start) $x = "NADCHODZI";
        if ($today > $end) $x = "ZAKOŃCZONY";
        if (($today >= $start) && ($today <= $end)) $x = "TRWA";
        return $x;
    }

    static function score($startDate, $endDate, $p_max)
    {
        $now = now(); // Aktualny czas
        // Obliczanie czasu który upłynał
        $timeElapsed = strtotime($now) - strtotime($startDate);
        //Czas trwania konkursu
        $totalDuration = strtotime($endDate) - strtotime($startDate);
        // Sprawdenie czy czas nie przekracza maksymalnej aktywności zadania
        $timeElapsed = min($timeElapsed, $totalDuration);

        //dd(sprintf("%.3f", M_PI_2));

        // $score = $p_max * , cos($timeElapsed * (M_PI_2 / ($totalDuration))));
        $score = sprintf("%.3f", ($p_max * cos($timeElapsed * (M_PI_2 / ($totalDuration)))));
        //$score = $p_max * round(cos($timeElapsed * (M_PI_2 / ($totalDuration))), 3);
        return $score;
    }
}
