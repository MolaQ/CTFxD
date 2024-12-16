<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $results = [
            ['user_id' => 1, 'task_id' => 1, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 724.990],
            ['user_id' => 2, 'task_id' => 1, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 712.19,],
            ['user_id' => 3, 'task_id' => 1, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 885.67,],
            ['user_id' => 4, 'task_id' => 1, 'response' => 'Zadanie3', 'is_correct' => false, 'points' => 896.870],
            ['user_id' => 1, 'task_id' => 2, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 767.990],
            ['user_id' => 2, 'task_id' => 2, 'response' => 'Zadanie2', 'is_correct' => false, 'points' => 752.190],
            ['user_id' => 3, 'task_id' => 2, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 865.607],
            ['user_id' => 4, 'task_id' => 2, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 896.870],
            ['user_id' => 1, 'task_id' => 3, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 967.990],
            ['user_id' => 2, 'task_id' => 3, 'response' => 'Zadanie4', 'is_correct' => false, 'points' => 952.870],
            ['user_id' => 3, 'task_id' => 3, 'response' => 'Zadanie2', 'is_correct' => true, 'points' => 665.952],
            ['user_id' => 4, 'task_id' => 3, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 714.752],
            ['user_id' => 1, 'task_id' => 4, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 767.990],
            ['user_id' => 2, 'task_id' => 4, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 952.870],
            ['user_id' => 3, 'task_id' => 4, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 865.952],
            ['user_id' => 4, 'task_id' => 4, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 782.752],
            ['user_id' => 1, 'task_id' => 5, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 767.990],
            ['user_id' => 2, 'task_id' => 5, 'response' => 'Zadanie4', 'is_correct' => false, 'points' => 952.870],
            ['user_id' => 3, 'task_id' => 5, 'response' => 'Zadanie4', 'is_correct' => false, 'points' => 865.952],
            ['user_id' => 4, 'task_id' => 5, 'response' => 'Zadanie4', 'is_correct' => true, 'points' => 982.752],
        ];
        // Wstawianie danych do tabeli schools
        DB::table('results')->insert($results);
    }
}
