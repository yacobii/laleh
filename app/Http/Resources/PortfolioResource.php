<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'link'  => route('portfolio', ['portfolio' => $this->id]),
            'body'  => str()->words($this->body, 100),
            'image' => $this->getFirstMediaUrl('portfolio') ?: null,
        ];
    }
}
