<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_time', 'end_time'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    static function status($startDate, $endDate)
    {
        $now = strtotime(now());
        if ($now < strtotime($startDate)) return ["status" => "Coming soon", "color" => "info"];
        if ($now > strtotime($endDate)) return ["status" => "Expired", "color" => "danger"];
        else return ["status" => "In Progress", "color" => "success"];
    }
}
