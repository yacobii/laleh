<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Random\RandomException;

class ServiceResource extends JsonResource
{
    /**
     * @throws RandomException
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),

            'status'       => (bool) $this->status,
            'published'    => (bool) $this->published,
            'portfolio_id' => random_int(1, 5),

            'link' => route('service', ['service' => $this->id]),

            'branches' => CenterResource::collection($this->whenLoaded('centers')),
            'credits'  => CreditResource::collection($this->whenLoaded('financialPlansTypes')),

            'employee_pivot' => $this->when($this->pivot !== null, fn () => [
                'id'         => $this->pivot->id,
                'subtitle'   => $this->pivot->subtitle,
                'from_price' => $this->pivot->from_price,
                'sort'       => $this->pivot->sort,
            ]),
        ];
    }
}
