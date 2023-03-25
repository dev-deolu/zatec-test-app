<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Validation\ValidationException;


interface ArtistServiceInterface
{
    /**
     * Get Artist
     */
    public function getArtist(User $user, string $artistId): ?array;

    /**
     * Get Favorite Artists
     */
    public function getFavoriteArtists(User $user): ?array;

    /**
     * Get Artist and Favorites with Search
     */
    public function getArtistAndFavoriteWithSearch(User $user, string $search = null): array;

    /**
     * Create a favorite artist record
     * @throws ValidationException
     */
    public function addFavoriteArtist(User $user, string $artistId): ?array;

    /**
     * Remove a favorite artist record
     */
    public function removeFavoriteArtist(User $user, string $artistId): bool;
}
