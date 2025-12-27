<?php

namespace App\Livewire;

use App\Models\Text;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Faq extends Component
{

    #[Computed]
    public function txt()
    {
        return Text::query()->find(1)->body;
    }

    public function render()
    {
        return view('livewire.faq');
    }
}
