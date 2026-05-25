<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */



    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->categories->pluck('id'),
            'brand_id' => $this->brand_id,
            'name' => $this->name,
            'price' => $this->price,
            'tariff' => $this->tariff,
            'discount' => 0,
            'image' => $this->image,
            'status' => $this->status,
            'type' => $this->type,
            'shipment_time' => $this->shipment_time,
            'link' => route('product', ['product' => $this->id]),
        ];
    }
}
