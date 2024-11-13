<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['contest_id', 'title', 'description', 'solution', 'points'];

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
