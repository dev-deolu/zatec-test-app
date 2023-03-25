<?php
namespace App\Interfaces;

use App\Models\User;

interface AlbumServiceInterface
{
     /**
     * Get Album
     */
    public function getAlbum(User $user, string $albumId, string $artistId): ?array;

    /**
     * Get Favorite Albums
     */
    public function getFavoriteAlbums(User $user): ?array;

    /**
     * Get Album and Favorites with Search
     */
    public function getAlbumAndFavoriteWithSearch(User $user, string $search = null): array;

    /**
     * Create a favorite album record
     * @throws ValidationException
     */
    public function addFavoriteAlbum(User $user, string $albumId, string $artistId): ?array;

    /**
     * Remove a favorite album record
     */
    public function removeFavoriteAlbum(User $user, string $albumId, string $artistId): bool;
}
