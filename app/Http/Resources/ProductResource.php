<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),

            [
                'category_ids' => $this->whenLoaded(
                    'categories',
                    fn () => $this->categories->pluck('id')->values()
                ),

                'categories' => CategoryResource::collection(
                    $this->whenLoaded('categories')
                ),

                'link' => route('product', [
                    'product' => $this->id,
                ]),

                'ghorfe_pivot' => $this->whenPivotLoaded(
                    'ghorfe_online_list_product',
                    fn () => [
                        'id' => $this->pivot->id,
                        'user_id' => $this->pivot->user_id,
                        'price' => $this->pivot->price,
                        'stock' => $this->pivot->stock,
                        'purchase_type' => $this->pivot->purchase_type,
                        'pay_type' => $this->pivot->pay_type,
                        'tariff_id' => $this->pivot->tariff_id,
                        'guarantee' => $this->pivot->guarantee,
                        'created_at' => $this->pivot->created_at,
                        'updated_at' => $this->pivot->updated_at,
                    ]
                ),
            ]
        );
    }
}
