<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type'          => 'user',
            'id'            => $this->id(),
            'name'          => $this->name(),
            'type'          => $this->type(),
            'image'          => $this->image(),
            'links'         => [
                'self'      => url('/user', $this->id()),
            ],
        ];
    }
}