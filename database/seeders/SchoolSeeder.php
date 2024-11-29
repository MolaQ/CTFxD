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
            ['name' => '---', 'city' => '---', 'category' => 'none'],
            ['name' => 'Zespół Szkół Technicznych w Pile', 'city' => 'Piła', 'category' => 'secondary'],
            ['name' => 'Zespół Szkół Budownlanych', 'city' => 'Piła', 'category' => 'secondary'],
            ['name' => 'Zespół Szkół Ekonomicznych', 'city' => 'Piła', 'category' => 'secondary'],
            ['name' => 'Zespół Szkół Gastronomicznych', 'city' => 'Piła', 'category' => 'secondary'],
            ['name' => 'Centrum Kształcenia Zawodowego i Ustawicznego', 'city' => 'Wyrzysk', 'category' => 'secondary'],
            ['name' => 'Szkoła Podstawowa nr 12 z Oddziałami Integracyjnymi', 'city' => 'Wyrzysk', 'category' => 'primary'],
        ];
        // Wstawianie danych do tabeli schools
        DB::table('schools')->insert($schools);
    }
}
