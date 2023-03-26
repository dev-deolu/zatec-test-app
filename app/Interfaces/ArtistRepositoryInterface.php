<?php

namespace App\Interfaces;

use App\Models\Artist;

interface ArtistRepositoryInterface
{
    /**
     * Create a favorite artist record
     */
    public function addFavoriteArtist(int $user_id, array $artist): ?Artist;

    /**
     * Remove from favorite artist record
     */
    public function removeFavoriteArtist(int $user_id, string $artist): bool;

    /**
     * Find favorite Artist by Artist
     */
    public function findFavoriteArtist(int $user_id, string $artist): ?Artist;
}
