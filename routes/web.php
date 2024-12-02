<?php

use App\Livewire\Admin\AdminContests;
use App\Livewire\Admin\AdminPanel;
use App\Livewire\Admin\AdminSchools;
use App\Livewire\Admin\AdminTasks;
use App\Livewire\Admin\AdminTeams;
use App\Livewire\Admin\AdminUsers;
use App\Livewire\Components\Logout;
use App\Livewire\HomePage;
use App\Livewire\LoginPage;
use App\Livewire\RegisterPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

//GUEST
Route::middleware('guest')->group(function () {

    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
});
//STUDENT
Route::middleware('auth')->group(
    function () {
        Route::get('/logout', Logout::class)->name('logout');
    }
);
//ADMIN

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/adminpanel', AdminPanel::class)->name('dashboard');
    Route::get('/adminpanel/schools', AdminSchools::class)->name('admin.schools');
    Route::get('/adminpanel/users', AdminUsers::class)->name('admin.users');
    Route::get('/adminpanel/teams', AdminTeams::class)->name('admin.teams');
    Route::get('/adminpanel/contests', AdminContests::class)->name('admin.contests');
    Route::get('/adminpanel/tasks', AdminTasks::class)->name('admin.tasks');
});
