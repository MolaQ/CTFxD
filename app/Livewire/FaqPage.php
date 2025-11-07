<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class FaqPage extends Component
{
    public string $search = '';

    public function render()
    {
        // Używamy "when", aby warunkowo dodać zapytanie wyszukiwania
        // Jest to bardziej czytelne niż blok "if"
        $allFaqs = Faq::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order', 'asc')
            ->get();

        return view('livewire.faq-page', [
            'allFaqs' => $allFaqs,
        ]);
    }
}
