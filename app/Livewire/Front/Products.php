<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{

    use WithPagination;

    public $page = 10;

    public int|null $idd = null;

    #[Computed]
    public function products()
    {
        $idd = $this->idd;

        if ($idd) {
            $category = Category::with('children')->find($idd);

            if ($category && $category->children->count()) {
                return Product::active()
                    ->whereIn('category_id', $category->children->pluck('id'))
                    ->orderBy('id', 'desc')
                    ->simplePaginate($this->page);
            }

            return $category?->products()
                ->active()
                ->orderBy('id', 'desc')
                ->simplePaginate($this->page);
        }

        return Product::active()
            ->orderBy('id', 'desc')
            ->simplePaginate($this->page);
    }


    public function filterByCategory(int $id)
    {
        $this->idd = $id;
    }

    public function loadMore()
    {
        $this->page += 10;
    }

//    public function placeholder(array $params = [])
//    {
//        return view('placeholders.products', $params);
//    }

    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->get();
    }

    public function updatedIdd()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.front.products');
    }
}
