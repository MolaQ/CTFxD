<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqPage extends Component
{
    public $search;
    public function render()
    {
        $faqsQuery = Faq::query();
        //POBRANIE WG KOLEJNOSCI


        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $faqsQuery->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        }
        //$faqsQuery->orderBy('order', 'ASC');
        $allFaqs = $faqsQuery->orderBy('order', 'ASC')->get();

        //$allFaqs = Faq::orderBy('order', 'ASC')->get();
        return view('livewire.faq-page', [
            'allFaqs' => $allFaqs,
        ]);
    }
}
