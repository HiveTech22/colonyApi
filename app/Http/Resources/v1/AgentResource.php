<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type'          => 'agent',
            'id'            => $this->id(),
            'name'          => $this->name(),
            'links'         => [
                'self'      => route('agents', $this->id()),
            ],
        ];
    }
}