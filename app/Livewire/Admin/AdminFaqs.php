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
    public $title = "FAQ", $search, $isOpen, $faq_id;

    public function openModal()
    {
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function create()
    {
        $this->openModal();
        $this->reset('form.name', 'form.description', 'form.order');
    }

    public function store()
    {
        $this->validate();

        Faq::updateOrCreate(['id' => $this->faq_id], [
            'name' => $this->form->name,
            'description' => $this->form->description,
            'order' => $this->form->order ? $this->form->order : Faq::max('order') + 1,
        ]);

        $this->faq_id ? $this->alert('success', 'FAQ updated successfully.', ['timer' => 6000,])
            : $this->alert('success', 'FAQ created successfully.', ['timer' => 6000,]);

        $this->reset('form.name', 'form.description', 'form.order');
        $this->closeModal();
    }
    public function modify($id)
    {
        $team = Faq::findOrFail($id);
        $this->faq_id = $id;
        $this->form->name = $team->name;
        $this->form->description = $team->description;
        $this->form->order = $team->order;

        $this->openModal();
    }

    public function orderUp($id)
    {
        $f1 = Faq::where('order', $id)->first();

        $f2 = Faq::where('order', $id - 1)->first();
        $temp = $f1->order;

        $f1->update([
            'name' => $f1->name,
            'description' => $f1->description,
            'order' => $f2->order,
        ]);
        $f2->update([
            'name' => $f2->name,
            'description' => $f2->description,
            'order' => $temp,
        ]);
        $this->alert('success', 'Przeniesiono pozycję w górę');
    }

    public function orderDown($id)
    {
        $f1 = Faq::where('order', $id)->first();

        $f2 = Faq::where('order', $id + 1)->first();
        $temp = $f1->order;

        $f1->update([
            'name' => $f1->name,
            'description' => $f1->description,
            'order' => $f2->order,
        ]);
        $f2->update([
            'name' => $f2->name,
            'description' => $f2->description,
            'order' => $temp,
        ]);
        $this->alert('success', 'Przeniesiono pozycję w dół');
    }


    public function delete($id)
    {
        Faq::find($id)->delete();
        $this->alert('success', 'FAQ deleted successfully.', ['timer' => 6000,]);
    }

    public function render()
    {
        $faqsQuery = Faq::query();
        //POBRANIE WG KOLEJNOSCI


        // Filtrowanie po wyszukiwaniu (name, email, school name)
        if (!empty($this->search)) {
            $faqsQuery->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        }
        //$faqsQuery->orderBy('order');
        $allFaqs = $faqsQuery->orderBy('order')->paginate(20);

        return view('livewire.admin.admin-faqs', [
            'allFaqs' => $allFaqs,
        ]);
    }
}
