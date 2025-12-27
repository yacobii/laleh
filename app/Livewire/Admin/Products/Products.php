<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{


    public $term;

    public $page = 15;

    public $category_id;

    #[Computed]
    #[On('refresh')]
    public function products()
    {
        // if no category selected yet, just return empty paginator
        if (!$this->category_id) {
            return Product::query()
                ->where('title', 'like', '%' . $this->term . '%')
                ->orderBy('order')
                ->paginate($this->page);
        }



        $cats = Category::find($this->category_id)?->children->pluck('id') ?? collect();

        return Product::query()
            ->whereIn('category_id', $cats)
            ->where('title', 'like', '%' . $this->term . '%')
            ->orderBy('order')
            ->paginate($this->page);
    }

    public function dilitProduct(Product $product)
    {
        $product->delete();

    }

    public function updateProductOrder($order)
    {
        foreach ($order as $item) {
            Product::find($item['value'])->update(['order' => $item['order']]);
        }

        $this->dispatch('refresh');
    }


    public function loadMore()
    {
        $this->page += 10;
    }

    public $rate;

    public function add_discount()
    {
        $this->validate(['rate' => 'required']);

        $discountRate = $this->rate / 100; // Convert percentage to decimal
        $price_with_discounted = DB::raw("price * (1 - $discountRate)");

        Product::query()->update([
            'rate' => $this->rate,
            'discounted' => 1,
            'price_with_discount' => $price_with_discounted
        ]);
    }

    public function remove_discount()
    {
        Product::query()->update([
            'rate' => null,
            'discounted' => 0,
            'price_with_discount' => DB::raw("price")
        ]);
    }

    #[Computed]
    public function categories(): Collection
    {
        return Category::isRoot()->get();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.products');
    }
}
