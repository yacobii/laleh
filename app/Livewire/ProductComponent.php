<?php

namespace App\Livewire;

use App\Klass\CartInterface;
use App\Klass\CartKlass;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Maize\Markable\Models\Favorite;

class ProductComponent extends Component
{
    public Product $product;

    public $selected_color;
    public $show_message = false;
    public $selected_size;

    #[Computed]
    public function colors()
    {
        return $this->product->colors;
    }


    #[Computed]
    public function sizes()
    {
        return $this->product->sizes;
    }





    #[Computed]
    public function productInCart()
    {
        $cart = app(CartKlass::class)->contents();

        return $cart->contains('product_id', $this->product->id);
    }

    public function remove(CartInterface $cart)
    {
        $cart->remove($this->product);
        $this->dispatch('refresh')->to('menu-cart');

    }

    public function add(CartInterface $cart)
    {
        // Only validate if there are multiple options available
        if (count($this->product->colors) > 1) {
            $this->validate(['selected_color' => 'required'], ['selected_color.required' => 'لطفا رنگ را انتخاب کنید']);
        }

        if (count($this->product->sizes) > 1) {
            $this->validate(['selected_size' => 'required'], ['selected_size.required' => 'لطفا سایز را انتخاب کنید']);
        }

        // Set default values if there's only one option
        $color = count($this->product->colors) === 1
            ? $this->product->colors->first()->id
            : $this->selected_color;

        $size = count($this->product->sizes) === 1
            ? $this->product->sizes->first()->id
            : $this->selected_size;

        $options = [
            'color' => $color ?? 35,
            'size' => $size ?? 35,
            'price' => $this->product->price,
        ];

        $cart->add($this->product, $options);

        $this->reset('selected_size', 'selected_color');
        $this->dispatch('refresh')->to('menu-cart');
        $this->show_message = true;
    }

    public function fav()
    {
        Favorite::toggle($this->product, auth()->user());
    }


    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.product-component');
    }
}
