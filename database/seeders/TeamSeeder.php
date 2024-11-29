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
        ]);
        Team::create([
            'name' => 'Mechan SpecIT',
        ]);
        Team::create([
            'name' => 'M|Society',
        ]);
    }
}