<?php

namespace App\Livewire\Admin\Snappshopp;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    public $term = '';
    public int $perPage = 10;
    public int $page = 1;
    public bool $hasMore = false;
    public bool $isLoading = false;
    public $allProducts = []; // To store all loaded products

    #[Computed]
    public function prods()
    {
        // Return filtered products from all loaded products
        return collect($this->allProducts)
            ->when($this->term, function ($collection) {
                return $collection->filter(function ($product) {
                    return str_contains(
                        strtolower($product['title']),
                        strtolower($this->term)
                    );
                });
            });
    }

    public function search()
    {
        $this->reset('allProducts', 'page', 'hasMore');
        $this->loadProducts();
    }

    public function loadProducts()
    {
        if ($this->isLoading) return;

        $this->isLoading = true;

        $baseUrl = config('snappshop.base_url');
        $token = config('snappshop.token');

        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($baseUrl . "/vendors/09kxMZ/products", [
            'page' => $this->page,
            'per_page' => $this->perPage,
        ]);

        if ($res->successful()) {
            $data = $res->json();
            $pagination = $data['meta']['pagination'];

            $this->hasMore = !empty($pagination['links']['next']);

            // Merge new products with existing ones
            $this->allProducts = array_merge(
                $this->allProducts,
                $data['data']
            );
        }

        $this->isLoading = false;
    }

    public function loadMore()
    {
        if ($this->hasMore && !$this->isLoading) {
            $this->page++;
            $this->loadProducts();
        }
    }

    public function mount()
    {
        $this->loadProducts();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.snappshopp.products');
    }
}
