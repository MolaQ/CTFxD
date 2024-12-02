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
            'school_id' => null,
            'team_id' => null,
            'is_admin' => true,
            'is_active' => true,
        ]);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.pl',
            'password' => Hash::make('12345678'),
            'school_id' => null,
            'team_id' => null,
            'is_admin' => false,
            'is_active' => false,
        ]);
        $user = User::create([
            'name' => 'second user',
            'email' => 'second@user.pl',
            'password' => Hash::make('12345678'),
            'school_id' => null,
            'team_id' => null,
            'is_admin' => false,
            'is_active' => false,
        ]);
        $user = User::create([
            'name' => 'third user',
            'email' => 'third@user.pl',
            'password' => Hash::make('12345678'),
            'school_id' => 3,
            'team_id' => null,
            'is_admin' => false,
            'is_active' => false,
        ]);
    }
}
