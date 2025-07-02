<?php

namespace App\Providers;

class RepositoryServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contract\PlaceRepositoryInterface::class,
            \App\Repositories\PlaceRepository::class
        );
    }

    public function boot(): void {}
}
