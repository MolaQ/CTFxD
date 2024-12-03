<?php

namespace Database\Seeders;

use App\Models\Contest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contest::create([
            'name' => 'Mechaniczny Detektyw',
            'description' => 'Konkurs Umiejętności Informatycznych',
            'start_time' => '2024-12-02 22:00:00',
            'end_time' => '2024-12-16 22:00:00',
        ]);

        Contest::create([
            'name' => 'Matematyczna Liga Zadaniowa',
            'description' => 'Konkurs Umiejętności Matematycznych',
            'start_time' => '2024-12-09 22:00:00',
            'end_time' => '2024-12-23 22:00:00',
        ]);

        Contest::create([
            'name' => 'Renowlanka z Budowacji',
            'description' => 'Konkurs umiejętności budowlano-renowacyjnych',
            'start_time' => '2024-12-10 22:00:00',
            'end_time' => '2024-12-24 22:00:00',
        ]);
    }
}
