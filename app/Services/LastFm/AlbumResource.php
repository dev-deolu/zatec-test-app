<?php

namespace App\Services\LastFm;

use App\Services\LastFmService;
use Illuminate\Http\Client\Response;

class AlbumResource
{
    public function __construct(private readonly LastFmService $service)
    {
    }

    /**
     * Request api call
     */
    private function call(string $limit, array $query): Response
    {
        return $this->service->get(
            url: "/2.0/",
            query: array_merge(['api_key' => $this->service->api_key, 'format' => 'json', 'limit' => $limit], $query)
        );
    }

    /**
     * Search for album
     */
    public function search(string $album, string $limit = '100'): ?array
    {
        return $this->call($limit, ['method' => 'album.search', 'album' => $album])->json()['results']['albummatches']['album'] ?? NULL;
    }

    /**
     * Get Album info
     */
    public function getInfo(string $album, string $artist, string $limit = '100'): ?array
    {
        return $this->call($limit, ['method' => 'album.getinfo', 'artist' => $artist, 'album' => $album])->json()['album'] ?? NULL;
    }
}
