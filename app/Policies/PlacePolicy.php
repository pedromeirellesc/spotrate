<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;

class PlacePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Place $place): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Place $place): bool
    {
        return $user->id == $place->user_id || $user->isAdmin()
            ? true
            : false;
    }

    public function delete(User $user, Place $place): bool
    {
        return $user->id == $place->user_id || $user->isAdmin()
            ? true
            : false;
    }

    public function restore(User $user, Place $place): bool
    {
        return $user->id == $place->user_id || $user->isAdmin()
            ? true
            : false;
    }

    public function forceDelete(User $user, Place $place): bool
    {
        return $user->id == $place->user_id || $user->isAdmin()
            ? true
            : false;
    }
}
