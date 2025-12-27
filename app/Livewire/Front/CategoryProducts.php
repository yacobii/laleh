<?php

namespace App\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryProducts extends Component
{

    public Category $category;

    public $page = 20;

    public $option = 'latest';
    public $category_id;

    #[Computed]
    public function products(): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Product::query();

        $query = match ($this->option) {
            'lowest' => $query->orderBy('price'),
            'highest' => $query->orderBy('price', 'desc'),

            default => $query->latest()
        };

        if ($this->category_id){
            return $query->where('category_id', $this->category_id)->paginate($this->page);
        }
        return $query->whereIn('category_id', $this->category->children->pluck('id'))->paginate($this->page);
    }

    #[Computed]
    public function children()
    {
        return $this->category->children;
    }


    public function render()
    {
        return view('livewire.front.category-products');
    }
}
