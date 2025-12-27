<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ColorDilit extends Component
{
    public $color;

    public function dilit() {
        $this->color->delete();
        $this->dispatch('refresh')->to('admin.products.colors');
    }

    public function render()
    {
        return view('livewire.admin.color-dilit');
    }
}
