<?php

namespace App\Providers;

use App\Observers\CacheInvalidationObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Place;
use App\Models\Review;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $models = [
            Place::class,
            Review::class
        ];

        foreach ($models as $model) {
            $model::observe(CacheInvalidationObserver::class);
        }
    }
}
