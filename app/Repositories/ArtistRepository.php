<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Interfaces\ArtistRepositoryInterface;

class ArtistRepository implements ArtistRepositoryInterface
{

    public function findFavoriteArtist(int $user_id, string $artist): ?Artist
    {
        return Artist::where('user_id', $user_id)->identifier($artist)->first();
    }

    public function addFavoriteArtist(int $user_id, array $artist): ?Artist
    {
        return Artist::create(['user_id' => $user_id, 'artist' => $artist]);
    }

    public function removeFavoriteArtist(int $user_id, string $artist): bool
    {
        return Artist::where('user_id', $user_id)->identifier($artist)->delete();
    }
}
