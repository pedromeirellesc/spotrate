<?php

namespace App\Providers;

class RepositoryServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Contracts\PlaceRepositoryInterface::class,
            \App\Repositories\PlaceRepository::class
        );
        $this->app->bind(
            \App\Contracts\ReviewRepositoryInterface::class,
            \App\Repositories\ReviewRepository::class
        );
    }

    public function boot(): void {}
}
