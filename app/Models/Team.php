<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'manager_id'];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    //Realacja do zespołu
    public function manager()
    {
        return $this->belongsTo(User::class);
    }
}
