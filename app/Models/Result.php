<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'task_id', 'response', 'attempts', 'is_correct', 'points'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function incrementAttempts()
    {
        $this->attempts++;
        $this->save();
    }

    public function hasExceededAttempts()
    {
        return $this->attempts >= 10;
    }
}
