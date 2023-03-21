<?php

namespace App\Services;

use App\Services\LastFm\AlbumResource;
use App\Services\LastFm\ArtistResource;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class LastFmService
{
    public function __construct(private readonly string $baseUrl, public readonly string $api_key)
    {
    }

    public function buildRequestWithApiKey(): PendingRequest
    {
        return Http::baseUrl(url: $this->baseUrl);
    }

    /**
     * Issue a GET request to the given URL.
     *
     * @param  string  $url
     * @param  array|string|null  $query
     * @return \Illuminate\Http\Client\Response
     */
    public function get(PendingRequest $request, string $url, $query = null): Response
    {
        return $request->get(
            url: $url,
            query: $query
        );
    }

    /**
     * Issue a POST request to the given URL.
     *
     * @param  string  $url
     * @param  array  $data
     * @return \Illuminate\Http\Client\Response
     */
    public function post(PendingRequest $request, string $url, array $payload = []): Response
    {
        return $request->post(
            url: $url,
            data: $payload,
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
