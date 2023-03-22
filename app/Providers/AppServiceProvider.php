<?php

namespace App\Providers;

use App\Services\LastFmService;
use App\Repositories\AlbumRepository;
use App\Repositories\ArtistRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AlbumRepositoryInterface;
use App\Interfaces\ArtistRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->bind(ArtistRepositoryInterface::class, ArtistRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton(
            abstract: LastFmService::class,
            concrete: fn () => new LastFmService(
                baseUrl: strval(config('services.lastfm.base_url')),
                api_key: config('services.lastfm.api_key'),
            ),
        );
    }
}
