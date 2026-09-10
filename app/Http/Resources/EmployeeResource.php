<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array_merge(
            parent::toArray($request),

            [
                'user' => new UserResource(
                    $this->whenLoaded('user')
                ),

                'services' => ServiceResource::collection(
                    $this->whenLoaded('services')
                ),

                'ghorfe_pivot' => $this->when(
                    $this->pivot !== null,
                    fn () => [
                        'id' => $this->pivot->id,
                        'sort' => $this->pivot->sort,
                    ]
                ),
            ]
        );
    }
}
