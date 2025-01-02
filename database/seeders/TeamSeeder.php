<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([
            'name' => 'Mechan WebDEV',
            'manager_id' => 1,
        ]);
        Team::create([
            'name' => 'Mechan SpecIT',
            'manager_id' => 1,
        ]);
        Team::create([
            'name' => 'M-Society',
            'manager_id' => null,
        ]);
    }
}
