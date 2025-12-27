<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{

    #[On('updated')]
    public function render()
    {
        return view('livewire.navigation');
    }
}
