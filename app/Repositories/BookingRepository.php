<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Events\BookingCreated;
use Illuminate\Support\Facades\DB;

class BookingRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            
            $booking = Booking::query()->create([
                'property_uuid' => data_get($attributes, 'property_id'),
                'author_id' => auth()->id(),
            ]);
            
            throw_if(!$booking, GeneralJsonException::class, 'Failed to create booking.');
            event(new BookingCreated($booking));
            return $booking;
        });
    }

    public function update($model, array $attributes)
    {
        
    }

    public function forceDelete($model)
    {
        
    }
}