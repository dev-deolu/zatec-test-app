<?php

namespace App\Repositories;

use App\Interfaces\AlbumRepositoryInterface;
use App\Models\Album;

class AlbumRepository implements AlbumRepositoryInterface
{
    public function findFavoriteAlbum(int $user_id, string $album, string $artist): ?Album
    {
        return Album::where('user_id', $user_id)->whereJsonContains('album->name', $album)->whereJsonContains('album->artist', $artist)->first();
    }

    public function addFavoriteAlbum(int $user_id, array $album): ?Album
    {
        return Album::create(['user_id' => $user_id, 'album' => $album]);
    }

    public function removeFavoriteAlbum(int $user_id, string $album, string $artist): bool
    {
        return Album::where('user_id', $user_id)->whereJsonContains('album->name', $album)->whereJsonContains('album->artist', $artist)->delete();
    }
}
