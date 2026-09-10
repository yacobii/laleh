<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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

            'category' => new CategoryResource($this->whenLoaded('category_article')),
            'image'    => $this->old_image ? url($this->old_image) : null,
            'link'     => route('article', ['article' => $this->id]),
        ];
    }
}
