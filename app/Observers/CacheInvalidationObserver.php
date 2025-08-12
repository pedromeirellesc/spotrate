<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\Review;
use App\Models\Place;

class CacheInvalidationObserver
{
    public function created(Model $model): void
    {
        $this->invalidateCache($model);
    }

    public function updated(Model $model): void
    {
        $this->invalidateCache($model);
    }

    public function deleted(Model $model): void
    {
        $this->invalidateCache($model);
    }

    private function invalidateCache(Model $model): void
    {
        $tags = [get_class($model)];

        // Invalidate cache for Place when Review is updated
        if ($model instanceof Review) {
            $tags[] = Place::class;
        }

        Cache::tags($tags)->flush();
    }
}
