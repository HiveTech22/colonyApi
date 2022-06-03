<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public static $wrap  = 'review';

    public function toArray($request)
    {
        return [
            'type'          => 'review',
            'id'            => $this->id(),
            'message'       => $this->message(),
            'rating'        => $this->rating(),
            'created'        => $this->createdAt(),
            'relationships'     => [
                'author'      => UserResource::make($this->author()),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'status'    => 'success',  
        ];
    }

    public function withResponse($request, $response)
    {
        $response->header('Accept', 'application/json');
    }
}