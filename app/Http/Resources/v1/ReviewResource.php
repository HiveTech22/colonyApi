<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type'          => 'reviews',
            'id'            => $this->id(),
            'message'       => $this->message(),
            'rating'        => $this->rating(),
            'relationships'     => [
                'author'      => UserResource::make($this->author()),
            ],
        ];
    }
}
