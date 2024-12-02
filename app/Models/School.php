<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'city',
        'category_id',
    ];
    // Relacja jeden do wielu (hasMany) z modelem User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
