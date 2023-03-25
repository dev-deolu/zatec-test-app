<?php

namespace App\Interfaces;

use App\Models\Album;

interface AlbumRepositoryInterface
{
    /**
     * Create a favorite album record
     */
    public function addFavoriteAlbum(int $user_id, array $album): ?Album;

    /**
     * Remove from favorite album record
     */
    public function removeFavoriteAlbum(int $user_id, string $album, string $artist): bool;

    /**
     * Find favorite Album by Album and Artist
     */
    public function findFavoriteAlbum(int $user_id, string $album, string $artist): ?Album;
}
