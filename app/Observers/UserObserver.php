<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function created(User $user)
    {
        $user->username = Str::slug($user->name . '.' . $user->id());
        $user->type = User::DEFAULT;
        $user->save();
    }
}