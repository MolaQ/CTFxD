<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.pl',
            'password' => Hash::make('password'),
            'school_id' => 4,
            'is_admin' => true,
        ]);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.pl',
            'password' => Hash::make('12345678'),
            'school_id' => 1,
            'is_admin' => false,
        ]);
    }
}
