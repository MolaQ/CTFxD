<?php

use App\Livewire\Admin\AdminContests;
use App\Livewire\Admin\AdminFaqs;
use App\Livewire\Admin\AdminPanel;
use App\Livewire\Admin\AdminSchools;
use App\Livewire\Admin\AdminTasks;
use App\Livewire\Admin\AdminTeams;
use App\Livewire\Admin\AdminUsers;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\RankPage;
use App\Livewire\SchoolDetails;
use App\Livewire\TasksPage;
use App\Livewire\TeamDetails;
use App\Livewire\UserDetails;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== TRASY PUBLICZNE (dla wszystkich) =====
Route::get('/', HomePage::class)->name('home');
Route::get('/rank', RankPage::class)->name('rank');
Route::get('/faq', FaqPage::class)->name('faq');
Route::get('/user/{id}', UserDetails::class)->name('user.details');
Route::get('/team/{id}', TeamDetails::class)->name('team.details');
Route::get('/school/{id}', SchoolDetails::class)->name('school.details');


// ===== TRASY DLA ZALOGOWANYCH UŻYTKOWNIKÓW (z middleware 'auth') =====
// Breeze domyślnie tworzy grupę dla 'dashboard', my ją rozszerzymy.
Route::middleware(['auth', 'verified'])->group(function () {
    // Panel Breeze (możemy go później dostosować lub usunąć)
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Twoja strona z zadaniami dla zalogowanego użytkownika
    Route::get('/tasks', TasksPage::class)->name('tasks');

    // Strona profilu od Breeze
    Route::view('profile', 'profile')->name('profile');
});


// ===== TRASY ADMINISTRATORA (z middleware 'auth' i 'admin') =====
Route::middleware(['auth', 'admin'])->prefix('adminpanel')->name('admin.')->group(function () {
    Route::get('/', AdminPanel::class)->name('panel');
    Route::get('/schools', AdminSchools::class)->name('schools');
    Route::get('/users', AdminUsers::class)->name('users');
    Route::get('/teams', AdminTeams::class)->name('teams');
    Route::get('/contests', AdminContests::class)->name('contests');
    Route::get('/tasks', AdminTasks::class)->name('tasks');
    Route::get('/faqs', AdminFaqs::class)->name('faqs');
});


// Dołącza trasy uwierzytelniania z Breeze (logowanie, rejestracja, etc.)
// Ten plik został teraz poprawnie utworzony przez nową instalację Breeze.
require __DIR__ . '/auth.php';
