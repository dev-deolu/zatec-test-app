<?php

namespace App\Services;

use App\Services\LastFm\AlbumResource;
use App\Services\LastFm\ArtistResource;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class LastFmService
{
    public function __construct(
        private readonly string $baseUrl,
        public readonly string $api_key
    ) {
    }

    /**
     * Build request base url
     */
    public function buildBaseUrl(): PendingRequest
    {
        return Http::baseUrl(url: $this->baseUrl);
    }

    /**
     * Issue a GET request to the given URL.
     */
    public function get(string $url = '/2.0/', array $query = []): Response
    {
        return $this->buildBaseUrl()->get(
            url: $url,
            query: $query
        );
    }

    /**
     * Issue a POST request to the given URL.
     *
     * @param  array  $data
     */
    public function post(string $url, array $payload = []): Response
    {
        return $this->buildBaseUrl()->post(
            url: $url,
            data: $payload
        );
    }

    /**
     * Album Resource
     */
    public function album(): AlbumResource
    {
        return new AlbumResource(
            service: $this,
        );
    }

    /**
     * Artist Resource
     */
    public function artist(): ArtistResource
    {
        return new ArtistResource(
            service: $this,
        );
    }
}
