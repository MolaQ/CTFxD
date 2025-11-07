<?php

namespace App\Livewire;

use Livewire\Attributes\Layout; // <-- DODAJEMY IMPORT LAYOUT
use Livewire\Component;

#[Layout('layouts.app')] // <-- DODAJEMY DEKORATOR LAYOUT
class HomePage extends Component
{
    public function render()
    {
        // Tutaj używamy makiety, którą stworzyliśmy wcześniej
        return view('livewire.home-page');
    }
}
