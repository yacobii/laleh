<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'family' => $this->family,
            'full_name' => trim($this->name . ' ' . $this->family),
            'phone' => $this->phone,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'level' => $this->level,
            'active' => (bool) $this->active,
            'wallet' => $this->wallet,
            'credit' => $this->credit,
        ];
    }
}
