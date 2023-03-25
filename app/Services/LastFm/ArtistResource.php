<?php

namespace App\Services\LastFm;

use App\Services\LastFmService;
use Illuminate\Http\Client\Response;

class ArtistResource
{
    public function __construct(private readonly LastFmService $service)
    {
    }

    /**
     * Request to api service
     */
    private function call(string $limit, array $query): Response
    {
        return $this->service->get(
            url: "/2.0/",
            query: array_merge(['api_key' => $this->service->api_key, 'format' => 'json', 'limit' => $limit], $query)
        );
    }

    /**
     * Search for artist
     */
    public function search(string $artist, string $limit = '100'): ?array
    {
        return $this->call($limit, ['method' => 'artist.search', 'artist' => $artist])->json()['results']['artistmatches']['artist'] ?? NULL;
    }

    /**
     * Get Album info
     */
    public function getInfo(string $artist, string $limit = '100'): ?array
    {
        return $this->call($limit, ['method' => 'artist.getinfo', str($artist)->isUuid() ? 'mbid' : 'artist'  => $artist])->json()['artist'] ?? NULL;
    }
}
