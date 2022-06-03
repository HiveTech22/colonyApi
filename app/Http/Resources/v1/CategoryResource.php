<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type'          => 'category',
            'id'            => $this->id(),
            'name'          => $this->name(),
        ];
    }
}