<?php

namespace App\Services;

use App\Interfaces\AlbumRepositoryInterface;
use App\Interfaces\AlbumServiceInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AlbumService implements AlbumServiceInterface
{
    /**
     * Create a new Album Service instance.
     *
     * @param  private AlbumRepositoryInterface $albumRepository
     * @param  private LastFmService $api
     * @return void
     */
    public function __construct(private AlbumRepositoryInterface $albumRepository, private LastFmService $api)
    {
    }

    /**
     * Get Album
     */
    public function getAlbum(User $user, string $albumId, string $artistId): ?array
    {
        // check the db
        $album = $this->albumRepository->findFavoriteAlbum($user->id, $albumId, $artistId);
        if ($album && ! empty($album->album)) {
            return $album->album;
        }

        return $this->api->album()->getInfo($albumId, $artistId);
    }

    /**
     * Get Favorite Albums
     */
    public function getFavoriteAlbums(User $user): ?array
    {
        $user->loadMissing('albums');

        return $user->albums->transform(function ($album) {
            return $album->album;
        })->toArray();
    }

    /**
     * Get Album and Favorites with Search
     */
    public function getAlbumAndFavoriteWithSearch(User $user, string $search = null): array
    {
        $albums = null;
        $favorites = $this->getFavoriteAlbums($user);

        $this->whenFilled($search, function ($search) use (&$albums) {
            $albums = $this->api->album()->search($search);
        }, function () use (&$albums, $favorites) {
            $albums = $favorites ?: $this->api->album()->search(fake()->realText(10), 15);
        });

        return [$albums, $favorites];
    }

    /**
     * Create a favorite album record
     *
     * @throws ValidationException
     */
    public function addFavoriteAlbum(User $user, string $albumId, string $artistId): ?array
    {
        // check the db
        $album = $this->albumRepository->findFavoriteAlbum($user->id, $albumId, $artistId);
        if ($album && ! empty($album->album)) {
            return $album->album;
        }
        // api call to get album
        if (($getAlbum = $this->api->album()->getInfo($albumId, $artistId))
            &&
            // store favorite album in db
            ($album = $this->albumRepository->addFavoriteAlbum($user->id, $getAlbum))
        ) {
            // store record of album to add to favorite
            return $album->album;
        }
        throw ValidationException::withMessages(['album' => 'error storing favorite album'])->status(406);
    }

    /**
     * Remove a favorite album record
     */
    public function removeFavoriteAlbum(User $user, string $albumId, string $artistId): bool
    {
        return $this->albumRepository->removeFavoriteAlbum($user->id, $albumId, $artistId);
    }

    /**
     * Apply the callback if variable contains a non-empty value for the given variable.
     *
     * @param  string|null  $search
     * @return $this|mixed
     */
    private function whenFilled($search, callable $callback, callable $default = null)
    {
        if (! empty($search)) {
            return $callback($search) ?: $this;
        }

        if ($default) {
            return $default();
        }

        return $this;
    }
}
