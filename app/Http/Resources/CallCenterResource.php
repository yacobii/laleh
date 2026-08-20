<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CallCenterResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sms_id' => $this->sms_id,
            'reg_id' => $this->reg_id,
            'user_id' => $this->user_id,
            'agent_id' => $this->agent_id,
            'representation_id' => $this->representation_id,
            'type' => $this->type,
            'request_type' => $this->request_type,
            'status' => $this->status,
            'description' => $this->description,
            'date_expire' => $this->date_expire,
            'time_expire' => $this->time_expire,
            'fast_expire' => $this->fast_expire,
            'reason_id' => $this->reason_id,

            'reason' => $this->whenLoaded('reason', function () {
                return [
                    'id' => $this->reason->id,
                    'title' => $this->reason->title,
                ];
            }),

            'user' => new UserResource($this->whenLoaded('user')),
            'agent' => new UserResource($this->whenLoaded('agent')),
        ];
    }
}
