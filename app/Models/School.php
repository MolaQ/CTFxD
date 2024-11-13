<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'city',
    ];
    // Relacja jeden do wielu (hasMany) z modelem User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
