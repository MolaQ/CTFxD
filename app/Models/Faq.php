<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['user_id', 'task_id', 'response', 'is_correct', 'points'];
}
