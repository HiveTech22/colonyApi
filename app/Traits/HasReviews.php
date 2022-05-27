<?php
namespace App\Traits;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasReviews
{
    public function reviews()
    {
        return $this->reviewsRelation;
    }

    public function reviewsRelation(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewsRelation', 'reviewable_type', 'reviewable_id');
    }

    public static function bootHasReviews()
    {
        static::deleting(function ($model) {
            $model->reviewsRelatione()->delete();
            $model->unsetRelation('reviewsRelation');
        });
    }

    public function reviewedBy(User $user)
    {
        $this->reviewsRelation()->create(['author_id' => $user->id()]);

        $this->unsetRelation('reviewsRelation');
    }

    public function disreviewedBy(User $user)
    {
        optional($this->reviewsRelation()->where('author_id', $user->id())->first())->delete();

        $this->unsetRelation('reviewsRelation');
    }

    public function isReviewedBy(User $user): bool
    {
        return $this->reviewsRelation()->where('author_id', $user->id())->exists();
    }
}