<?php

namespace App\Livewire\Admin\Products;

use App\Models\Color;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Colors extends Component
{

    public Product $product;

    #[Computed]
    public function colors()
    {
        return Color::query()->where('category_id', $this->product->category->parent->id)->get();
    }

    public function toggle($id)
    {
        $this->product->colors()->toggle($id);
        $this->product->load('colors');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.colors');
    }
}
