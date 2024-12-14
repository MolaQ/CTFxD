<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'name' => 'main faq',
            'description' => 'desription of main rule',
            'order' => 1,
        ]);
        Faq::create([
            'name' => 'fifth faq',
            'description' => 'desription of fifth rule',
            'order' => 1,
        ]);
        Faq::create([
            'name' => 'second faq',
            'description' => 'desription of second rule',
            'order' => 1,
        ]);
        Faq::create([
            'name' => 'third faq',
            'description' => 'desription of third rule',
            'order' => 1,
        ]);
        Faq::create([
            'name' => 'fourth faq',
            'description' => 'desription of fourth rule',
            'order' => 1,
        ]);
    }
}
