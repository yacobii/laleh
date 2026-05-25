<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Random\RandomException;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'branches' => CenterResource::collection($this->whenLoaded('centers')),
            'credits' => CreditResource::collection($this->whenLoaded('financialPlansTypes')),
            'portfolio_id' => random_int(1,5),
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'slug' => $this->slug,
            'description' => $this->description,
            'payment_method' => $this->payment_method,
            'insurance' => $this->insurance,
            'status' => (bool) $this->status,
            'published' => (bool) $this->published,
            'image' => $this->image,
            'icon' => $this->icon,
            'link' => route('service', ['service' => $this->id]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
