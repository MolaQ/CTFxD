<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Przedszkole'],
            ['name' => 'Szkoła podstawowa'],
            ['name' => 'Szkoła ponadpodstawowa'],
            ['name' => 'Szkoła wyższa'],
        ];
        DB::table('school_categories')->insert($categories);
    }
}
