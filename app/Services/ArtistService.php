<?php

namespace App\Services;

use App\Interfaces\ArtistRepositoryInterface;
use App\Interfaces\ArtistServiceInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class ArtistService implements ArtistServiceInterface
{
    /**
     * Create a new Artist Service instance.
     */
    public function __construct(
        private ArtistRepositoryInterface $artistRepository,
        private LastFmService $api
    ) {
    }

    /**
     * Get Artist
     */
    public function getArtist(User $user, $artistId): ?array
    {
        // check the db
        $artist = $this->artistRepository->findFavoriteArtist($user->id, $artistId);
        if ($artist && ! empty($artist->artist)) {
            return $artist->artist;
        }

        return $this->api->artist()->getInfo($artistId);
    }

    /**
     * Get Artist and Favorites with Search
     */
    public function getArtistAndFavoriteWithSearch(User $user, string $search = null): array
    {
        $favorites = $this->getFavoriteArtists($user);
        if (! empty($search)) {
            $artists = $this->api->artist()->search($search);
        } else {
            $artists = $favorites ?: $this->api->artist()->search(fake()->realText(10), 15);
        }

        return [$artists, $favorites];
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
     * Create a favorite artist record
     */
    public function addFavoriteArtist(User $user, string $artistId): ?array
    {
        // check the db
        $artist = $this->artistRepository->findFavoriteArtist($user->id, $artistId);
        if ($artist && ! empty($artist->artist)) {
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
        throw ValidationException::withMessages([
            'artist' => 'error storing favorite artist',
        ])->status(406);
    }

    /**
     * Remove favorite artist
     */
    public function removeFavoriteArtist(
        User $user,
        string $artistId
    ): bool {
        return $this->artistRepository->removeFavoriteArtist($user->id, $artistId);
    }
}
