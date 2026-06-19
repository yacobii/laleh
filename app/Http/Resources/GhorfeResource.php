<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GhorfeResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'phone' => $this->call,
            'address' => $this->address,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'description' => $this->description,
            'instagram' => $this->instagram,
            'telegram' => $this->telegram,
            'website' => $this->domain_active,

            'services' => ServiceResource::collection(
                $this->whenLoaded('services')
            ),

            'products' => ProductResource::collection(
                $this->whenLoaded('products')
            ),
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
            'galleries' => GalleryResource::collection($this->whenLoaded('galleries')),
            'users' => UserResource::collection($this->whenLoaded('users')),
        ];
    }
}
