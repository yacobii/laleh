<?php

namespace App\Livewire\Admin\Snappshopp;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SingleProduct extends Component
{

    public $product;

    #[Computed]
    public function prod()
    {
        $baseUrl = config('snappshop.base_url');
        $token = config('snappshop.token');

        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($baseUrl . "/vendors/09kxMZ/products/" . $this->product);

        if (! $res->successful()) {
            return collect(); // avoid null issues
        }

        $response = collect($res->json()['data']);
        return collect([
          'title' => $response['title'],
          'title_en' => $response['title_en'],
          'sku' => $response['sku'],
          'active' => $response['active'],
          'capacity' => $response['capacity'],
          'stock' => $response['stock'],
          'warehouse_stock' => $response['warehouse_stock'],
          'thumbnail' => $response['thumbnail'],
          'price' => $response['price'],
          'warranty' => $response['warranty'],
            'variation_attributes' => $response['variation_attributes'],
            'created_at' => $response['created_at']
        ]);
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.snappshopp.single-product');
    }
}
