<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $task = Task::create([
            'contest_id' => 1,
            'title' => 'Zadanie 1',
            'description' => 'Opis zadania pierwszego',
            'solution' => 'Zadanie4',
            'image' => 'img/task-images/230.png',
            'start_time' => '2024-12-09 22:00:00',
            'end_time' => '2024-12-11 22:00:00',
        ]);
        $task = Task::create([
            'contest_id' => 1,
            'title' => 'Zadanie 2',
            'description' => 'Opis zadania drugiego',
            'solution' => 'Zadanie4',
            'image' => 'img/task-images/230.png',
            'start_time' => '2024-12-09 22:00:00',
            'end_time' => '2024-12-11 22:00:00',
        ]);
        $task = Task::create([
            'contest_id' => 1,
            'title' => 'Zadanie 3',
            'description' => 'Opis zadania trzeciego',
            'solution' => 'Zadanie4',
            'image' => 'img/task-images/230.png',
            'start_time' => '2024-12-07 22:00:00',
            'end_time' => '2024-12-09 22:00:00',
        ]);
        $task = Task::create([
            'contest_id' => 1,
            'title' => 'Zadanie 4',
            'description' => 'Opis zadania czwartego',
            'solution' => 'Zadanie4',
            'image' => 'img/task-images/230.png',
            'start_time' => '2024-12-6 22:00:00',
            'end_time' => '2024-12-13 22:00:00',
        ]);
    }
}