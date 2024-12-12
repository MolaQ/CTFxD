<?php

namespace App\Livewire\Components;

use Illuminate\Foundation\Inspiring;
use Livewire\Component;

class Footer extends Component
{
    public $message;
    public function render()
    {
        $this->message = Inspiring::quote();
        $this->message = str_replace(["</>", "<options=bold>"], "", $this->message);
        $this->message = str_replace("<fg=gray>—", "-", $this->message);

        return view('livewire.components.footer');
    }
}
