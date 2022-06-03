<?php

namespace App\Http\Resources\v1;

use App\Http\Resources\v1\AgentResource;
use App\Http\Resources\v1\ReviewResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public static $wrap  = 'properties';
   
    
    public function toArray($request)
    {
        return [
            'type'              => 'properties',
            'id'                => $this->id(),
            'attribute'         => [
                'title'         => $this->title(),
                'slug'          => $this->slug(),
                'price'         => $this->price(),
                'bedroom'         => $this->bedroom(),
                'bathroom'         => $this->bathroom(),
                'built'         => $this->built(),
                'excerpt'       => $this->excerpt(100),
                'description'   => $this->description(),
                'image'         => $this->image(),
                'image2'         => $this->image2(),
                'image3'         => $this->image3(),
                'video'         => $this->video(),
                'purpose'     => $this->purpose(),
                'frequency'     => $this->frequency(),
                'address'     => $this->address(),
                'longitude'     => $this->longitude(),
                'latitude'      => $this->latitude(),
                'fence'         => $this->fence(),
                'pool'          => $this->pool(),
                'tiles'         => $this->tiles(),
                'conditioning'  => $this->conditioning(),
                'wifi'          => $this->wifi(),
                'park'          => $this->park(),
                'furnish'      => $this->furnish(),
                'laundry'      => $this->laundry(),
                'created_at'    => $this->createdAt()
            ],
            'relationships'     => [
                'agent'         => AgentResource::make($this->author()),
                'category'      => CategoryResource::make($this->category),
                'reviews'       => ReviewResource::collection($this->reviews),
            ],
            'links'             => [
                'self'          => route('properties.show', $this->id()),
                'related'       => route('properties.show', $this->slug())   
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