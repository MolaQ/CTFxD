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
            ['name' => 'Zespół Szkół Technicznych w Pile', 'city' => 'Piła', 'category_id' => 3],
            ['name' => 'Zespół Szkół Budownlanych', 'city' => 'Piła', 'category_id' => 3],
            ['name' => 'Zespół Szkół Ekonomicznych', 'city' => 'Piła', 'category_id' => 3],
            ['name' => 'Zespół Szkół Gastronomicznych', 'city' => 'Piła', 'category_id' => 3],
            ['name' => 'Centrum Kształcenia Zawodowego i Ustawicznego', 'city' => 'Wyrzysk', 'category_id' => 3],
            ['name' => 'Szkoła Podstawowa nr 12 z Oddziałami Integracyjnymi', 'city' => 'Piła', 'category_id' => 2],
            ['name' => 'Wyższa Szkoła Lansu i Balansu', 'city' => null, 'category_id' => null],
        ];
        // Wstawianie danych do tabeli schools
        DB::table('schools')->insert($schools);
    }
}
