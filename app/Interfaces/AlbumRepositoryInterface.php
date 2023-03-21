<?php

namespace App\Interfaces;

use App\Models\Album;

interface AlbumRepositoryInterface
{
    /**
     * Create a favorite album record
     */
    public function createAlbum(int $user_id, array $album): ?Album;

    /**
     * Delete a favorite album record
     */
    public function destroyAlbum(int $user_id, string $album, string $artist): bool;

    /**
     * Find by Album and Artist
     */
    public function findByAlbumArtist(int $user_id, string $album, string $artist): ?Album;
}
