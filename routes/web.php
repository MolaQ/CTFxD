<?php

use App\Livewire\Actions\Logout;
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


// ===== TRASY ADMINISTRATORA (z middleware 'auth' i 'admin') =====
Route::middleware(['auth', 'admin'])->prefix('adminpanel')->name('admin.')->group(function () {
    Route::get('/', AdminPanel::class)->name('panel');      // admin.panel
    Route::get('/schools', AdminSchools::class)->name('schools');  // admin.schools
    Route::get('/users', AdminUsers::class)->name('users');        // admin.users
    Route::get('/teams', AdminTeams::class)->name('teams');        // admin.teams
    Route::get('/contests', AdminContests::class)->name('contests');// admin.contests
    Route::get('/tasks', AdminTasks::class)->name('tasks');        // admin.tasks
    Route::get('/faqs', AdminFaqs::class)->name('faqs');           // admin.faqs
});

Route::post('/logout', Logout::class)->name('logout');

// Dołącza trasy uwierzytelniania z Breeze (logowanie, rejestracja, etc.)
// Ten plik został teraz poprawnie utworzony przez nową instalację Breeze.
require __DIR__ . '/auth.php';

