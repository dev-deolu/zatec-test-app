<?php
namespace App\Interfaces;

use App\Models\Artist;

interface ArtistRepositoryInterface
{
     /**
     * Create a favorite artist record
     */
    public function createArtist(int $user_id, array $artist): ?Artist;

    /**
     * Delete a favorite artist record
     */
    public function destroyArtist(int $user_id,  string $artist): bool;

    /**
     * Find by Artist
     */
    public function findArtist(int $user_id, string $artist): ?Artist;
}
