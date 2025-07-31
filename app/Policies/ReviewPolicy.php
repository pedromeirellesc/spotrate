<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class ReviewPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Review $review): bool
    {
        return !empty($user);
    }

    public function create(User $user, Place $place): bool
    {
        return !empty($user) && !Review::where('place_id', $place->id)
            ->where('user_id', $user->id)
            ->exists();
    }

    public function update(User $user, Review $review): bool
    {
        return $user->id === $review->user_id || $user->isAdmin();
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->id === $review->user_id || $user->isAdmin();
    }
}
