<?php

namespace App\Repositories;

use App\Models\Review;
use App\Events\ReviewCreated;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class ReviewRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $review = Review::query()->create([
                'rating' => data_get($attributes, 'rating'),
                'message' => data_get($attributes, 'message'),
                'property_uuid' => data_get($attributes, 'property_id'),
                'author_id' => auth()->id(),
            ]);
            
            throw_if(!$review, GeneralJsonException::class, 'Failed to create review.');
            event(new ReviewCreated($review));
            return $review;
        });
    }

    public function update($model, array $attributes)
    {
        
    }

    public function forceDelete($model)
    {
        
    }
}