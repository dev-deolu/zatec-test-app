<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Album;
use App\Interfaces\AlbumRepositoryInterface;

class AlbumRepository implements AlbumRepositoryInterface
{

    public function findByAlbumArtist(int $user_id, string $album, string $artist): ?Album
    {
        return Album::where('user_id', $user_id)->whereJsonContains('album->name', $album)->whereJsonContains('album->artist', $artist)->first();
    }

    public function createAlbum(int $user_id, array $album): ?Album
    {
        return Album::create(['user_id' => $user_id, 'album' => $album]);
    }

    public function destroyAlbum(int $user_id, string $album, string $artist): bool
    {
        return Album::where('user_id', $user_id)->whereJsonContains('album->name', $album)->whereJsonContains('album->artist', $artist)->delete();
    }
}
