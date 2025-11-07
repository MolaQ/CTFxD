<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt; // <-- DODAJ TEN IMPORT
use Livewire\Livewire; // <-- DODAJ TEN IMPORT

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- POCZĄTEK ZMIAN ---
        Volt::mount([
            resource_path('views/livewire/auth'),
            resource_path('views/pages'), // Dodajemy też 'pages', na wszelki wypadek
        ]);
        // --- KONIEC ZMIAN ---
    }
}
