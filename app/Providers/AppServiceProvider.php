<?php

namespace App\Providers;


use App\Services\AuthService;
use App\Services\AlbumService;
use App\Services\ArtistService;
use App\Services\LastFmService;
use App\Repositories\UserRepository;
use App\Repositories\AlbumRepository;
use App\Repositories\ArtistRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\AlbumServiceInterface;
use App\Interfaces\ArtistServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\AlbumRepositoryInterface;
use App\Interfaces\ArtistRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // repository app binding
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ArtistRepositoryInterface::class, ArtistRepository::class);
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        // service app binding
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ArtistServiceInterface::class, ArtistService::class);
        $this->app->bind(AlbumServiceInterface::class, AlbumService::class);
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
