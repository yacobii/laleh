<?php

namespace App\Livewire;

use App\Models\Color;
use Livewire\Component;

class ProductColorComponent extends Component
{

    public $color;

    public function selectColor($id) {
        $this->dispatch('color-images', color:$id);
    }



    public function render()
    {
        return view('livewire.product-color-component');
    }
}
