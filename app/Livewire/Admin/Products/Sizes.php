<?php

namespace App\Livewire\Admin\Products;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Sizes extends Component
{


    public Product $product;

    #[Computed]
    public function sizes()
    {
        return Size::query()->where('category_id', $this->product->category->parent->id)->get();
    }

    public function toggle($id)
    {
        $this->product->sizes()->toggle($id);
        $this->product->load('sizes');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.sizes');
    }
}
