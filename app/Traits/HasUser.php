<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    public function user(): User
    {
        return $this->userRelation;
    }

    public function useredBy(User $user)
    {
        $this->userRelation()->associate($user);
        $this->unsetRelation('userRelation');
    }

    public function userRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isUseredBy(User $user): bool
    {
        return $this->user()->matches($user);
    }
}