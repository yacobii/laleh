<?php

namespace App\Livewire;

use App\Models\Text;
use Livewire\Attributes\Computed;
use Livewire\Component;

class RahnamaOrder extends Component
{

    #[Computed]
    public function txt()
    {
        return Text::query()->find(4)->body;
    }

    public function render()
    {
        return view('livewire.rahnama-order');
    }
}
