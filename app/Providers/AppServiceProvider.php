<?php

namespace App\Providers;

use App\Repositories\AlbumRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AlbumRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
