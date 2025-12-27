<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class SliderComponent extends Component
{
    public Product $product;

    #[Computed]
    public function images()
    {
        return $this->product->media;
    }

    public function render()
    {
        return view('livewire.slider-component');
    }
}
