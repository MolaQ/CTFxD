<?php

use App\Livewire\Admin\AdminContests;
use App\Livewire\Admin\AdminFaqs;
use App\Livewire\Admin\AdminPanel;
use App\Livewire\Admin\AdminSchools;
use App\Livewire\Admin\AdminTasks;
use App\Livewire\Admin\AdminTeams;
use App\Livewire\Admin\AdminUsers;
use App\Livewire\Components\Logout;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\LoginPage;
use App\Livewire\RankPage;
use App\Livewire\RegisterPage;
use App\Livewire\SchoolDetails;
use App\Livewire\TasksPage;
use App\Livewire\TeamDetails;
use App\Livewire\UserDetails;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/rank', RankPage::class)->name('rank');
Route::get('/faq', FaqPage::class)->name('faq');
Route::get('/user/{id}', UserDetails::class)->name('user.details');
Route::get('/team/{id}', TeamDetails::class)->name('team.details');
Route::get('/school/{id}', SchoolDetails::class)->name('school.details');

//GUEST
Route::middleware('guest')->group(function () {

    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
});
//STUDENT
Route::middleware('auth')->group(
    function () {
        Route::get('/logout', Logout::class)->name('logout');
        Route::get('/tasks', TasksPage::class)->name('tasks');
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
    Route::get('/adminpanel/faqs', AdminFaqs::class)->name('admin.faqs');
});
