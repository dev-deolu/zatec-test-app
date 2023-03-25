<?php

namespace App\Services;

use App\Models\User;
use App\Services\LastFmService;
use App\Interfaces\ArtistServiceInterface;
use App\Interfaces\ArtistRepositoryInterface;
use Illuminate\Validation\ValidationException;

class ArtistService implements ArtistServiceInterface
{
    /**
     * Create a new Artist Service instance.
     *
     * @param  private ArtistRepositoryInterface $artistRepository
     * @param  private LastFmService $api
     * @return void
     */
    public function __construct(private ArtistRepositoryInterface $artistRepository, private LastFmService $api)
    {
    }

    /**
     * Get Artist
     */
    public function getArtist(User $user, $artistId): ?array
    {
        // check the db
        $artist = $this->artistRepository->findFavoriteArtist($user->id, $artistId);
        if ($artist && !empty($artist->artist)) {
            return $artist->artist;
        }
        return $this->api->artist()->getInfo($artistId);
    }

    /**
     * Get Favorite Artist
     */
    public function getFavoriteArtists(User $user): ?array
    {
        $user->loadMissing('artists');
        return $user->artists->transform(function ($artist) {
            return $artist->artist;
        })->toArray();
    }

    /**
     * Get Artist and Favorites with Search
     */
    public function getArtistAndFavoriteWithSearch(User $user, string $search = null): array
    {
        $artists = [];
        $favorites = $this->getFavoriteArtists($user);
        // check if search is filled
        $this->whenFilled($search, function ($search) use (&$artists) {
            $artists =  $this->api->artist()->search($search);
        }, function () use (&$artists, $favorites) {
            $artists = $favorites ?: $this->api->artist()->search(fake()->realText(10), 15);
        });
        return [$artists, $favorites];
    }

    /**
     * Create a favorite artist record
     */
    public function addFavoriteArtist(User $user, string $artistId): ?array
    {
        // check the db
        $artist = $this->artistRepository->findFavoriteArtist($user->id, $artistId);
        if ($artist && !empty($artist->artist)) {
            return $artist->artist;
        }
        // api call to get artist
        if (($getArtist = $this->api->artist()->getInfo($artistId))
            &&
            // store favorite artist in db
            ($artist = $this->artistRepository->addFavoriteArtist($user->id, $getArtist))
        ) {
            // store record of album to add to favorite
            return $artist->artist;
        }
        throw ValidationException::withMessages(['artist' => 'error storing favorite artist'])->status(406);
    }

    /**
     * Remove favorite artist
     */
    public function removeFavoriteArtist(User $user, string $artistId): bool
    {
        return $this->artistRepository->removeFavoriteArtist($user->id, $artistId);
    }

    /**
     * Apply the callback if variable contains a non-empty value for the given variable.
     *
     * @param  string|null  $search
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return $this|mixed
     */
    private function whenFilled($search, callable $callback, callable $default = null)
    {
        if (!empty($search)) {
            return $callback($search) ?: $this;
        }

        if ($default) {
            return $default();
        }
        return $this;
    }
}