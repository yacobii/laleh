<?php

namespace App\Livewire\Admin\Snappshopp;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{

    public $product;
    public $productId;

    public $title;
    public $price;
    public $sku;
    public $stock;
    public $thumbnail;
    public  $attribs = [];

public $date;


    public function mount()
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

        $product = $res->json()['data'];

        $this->title = $product['title'];
        $this->price = $product['price'];
        $this->sku = $product['sku'];
        $this->stock = $product['stock'];
        $this->productId = $product['id'];
        $this->thumbnail = $product['thumbnail'];
        $this->date = $product['created_at'];
        $this->attribs = $product['variation_attributes'] ?? [];
    }

    public function update()
    {

        $baseUrl = config('snappshop.base_url');
        $token = config('snappshop.token');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->patch($baseUrl . "/vendors/09kxMZ/products/", [
            'products' => [
                [
                    'id' => $this->productId, // make sure this is set
                    'sku' => $this->sku,
                    'title' => $this->title,
                    'price' => $this->price,
                    'stock' => $this->stock,
                ]
            ],
        ]);


        if ($response->successful()) {
            session()->flash('success', 'با موفقیت آپدیت شد.');
        } else {
            session()->flash('error', 'خطا در آپدیت محصول.');
        }
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.snappshopp.edit');
    }
}
