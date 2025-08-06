<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CacheInvalidationObserver
{
    public function saved(Model $model): void
    {
        Cache::tags([get_class($model)])->flush();
    }

    public function deleted(Model $model): void
    {
        Cache::tags([get_class($model)])->flush();
    }

    public function restored(Model $model): void
    {
        Cache::tags([get_class($model)])->flush();
    }
}
