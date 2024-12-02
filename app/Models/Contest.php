<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'start_time', 'end_time'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
