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
        // All raw columns (id, name, domain_active, description, ...)
        $data = parent::toArray($request);

        // Merge relationships on top
        return array_merge($data, [
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
        ]);
    }
}
