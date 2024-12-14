<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\AdminFaqsForm;
use App\Models\Faq;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class AdminFaqs extends Component
{
    use WithPagination;
    use LivewireAlert;
    public AdminFaqsForm $form;
    public $title = "FAQ", $search;

public function create()
{
    dd("create");
}

    public function render()
    {
        $allFaqs = Faq::paginate(10);
        return view('livewire.admin.admin-faqs',[
            'allFaqs' => $allFaqs,
        ]);
    }
}
