<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            ['name' => 'Szkoła Podstawowa nr 12 z Oddzialami Integracyjnymi w Pile', 'city' => 'Piła', 'category' => 'primary'],
            ['name' => 'Szkoła Podstawowa nr 2', 'city' => 'Piła', 'category' => 'primary'],
            ['name' => 'Zespół Szkół Technicznych nr 1 w Pile', 'city' => 'Piła', 'category' => 'secondary'],
            ['name' => 'Liceum Ogólnokształcące nr 2', 'city' => 'Piła', 'category' => 'secondary'],
        ];
        // Wstawianie danych do tabeli schools
        DB::table('schools')->insert($schools);
    }
}
