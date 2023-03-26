<?php

namespace App\Traits;

use Illuminate\Validation\ValidationException;

trait AlbumTrait
{
    /**
     * Get album and artist from id
     */
    public function getAlbumAndArtistFromId(string $string, int $arrayCount = 2, string $seperator = '|'): array
    {
        (array) $result = explode($seperator, $string);
        if (count($result) < $arrayCount) {
            throw ValidationException::withMessages(['id' => 'invalid id'])->status(406);
        }

        return $result;
    }
}
