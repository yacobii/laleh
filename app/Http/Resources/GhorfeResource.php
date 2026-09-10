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
            ...parent::toArray($request),

            'categories' => CategoryResource::collection(
                $this->whenLoaded('categories')
            ),

            'call_centers' => CallCenterResource::collection(
                $this->whenLoaded('callCenters')
            ),
            'services' => ServiceResource::collection(
                $this->whenLoaded('services')
            ),
            'products' => ProductResource::collection(
                $this->whenLoaded('products')
            ),
            'articles' => ArticleResource::collection(
                $this->whenLoaded('articles')
            ),
            'galleries' => GalleryResource::collection(
                $this->whenLoaded('galleries')
            ),
            'users' => UserResource::collection(
                $this->whenLoaded('users')
            ),
            'employees' => EmployeeResource::collection(
                $this->whenLoaded('employees')
            ),
        ];
    }
}
