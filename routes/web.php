<?php

use App\Livewire\Admin\AdminPanel;
use App\Livewire\Admin\AdminSchool;
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
    Route::get('/adminpanel/schools', AdminSchool::class)->name('admin.schools');
});
