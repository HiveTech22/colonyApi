<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\v1\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public static $wrap  = 'booking';
   
    
    public function toArray($request)
    {
        return [
            'type'                      => 'booking',
            'id'                        => $this->id(),
            'attribute'                 => [
                'created_at'            => $this->createdAt(),
                'payment'               => $this->payment(),
                'verification'          => $this->verification(),
            ],
            'relationships'     => [
                  'author'      => UserResource::make($this->author()),
                  'property'    => PropertyResource::make($this->property),
            ],
            'links'             => [
                'self'          => route('bookings.show', $this->id()),
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