<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheableRepository
{
    protected function remember(string $key, int $seconds, \Closure $callback, array $tags = []): mixed
    {
        return Cache::tags($tags)->remember($key, $seconds, $callback);
    }

    protected function flushTags(array $tags): void
    {
        Cache::tags($tags)->flush();
    }

    protected function makeCacheKey(string $prefix, $params = []): string
    {
        return $prefix . '_' . md5(json_encode($params));
    }
}
