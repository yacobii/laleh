<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallCenterResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),

            $this->mergeWhen($this->relationLoaded('reason'), [
                'reason' => [
                    'id' => $this->reason?->id,
                    'title' => $this->reason?->title,
                ],
            ]),

            'user' => UserResource::make($this->whenLoaded('user')),
            'agent' => UserResource::make($this->whenLoaded('agent')),
        ];
    }
}
