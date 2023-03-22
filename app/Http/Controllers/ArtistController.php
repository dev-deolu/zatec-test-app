<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\LastFmService;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\ArtistRepositoryInterface;
use App\Http\Requests\AddFavouriteArtistRequest;

class ArtistController extends Controller
{
    /**
     * Create a new artist controller instance.
     *
     * @param  ArtistRepositoryInterface $artistRepository
     * @return void
     */
    public function __construct(private ArtistRepositoryInterface $artistRepository, private LastFmService $api)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $artist = null;
        $favorites = $request->user()->artists->transform(function ($artist) {
            return $artist->artist;
        })->toArray();

        $request->whenFilled('search', function ($search) use (&$artist, $favorites) {
            $artist =  $this->api->artist()->search($search);
        }, function () use (&$artist, $favorites) {
            $artist = $favorites ?: $this->api->artist()->search(fake()->realText(10), 15);
        });
        return Inertia::render('Artist', [
            'artists' => $artist,
            'favorites' => $favorites ?? []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFavouriteArtistRequest $request)
    {
        // check the db
        $album = $this->artistRepository->findArtist($request->user()->id, $request->id);
        if ($album) {
            return Redirect::back();
        }
        // api call to get album
        if ($getAlbum = $this->api->artist()->info($request->id))
            // store record of album to add to favorite
            $this->artistRepository->createArtist($request->user()->id, $getAlbum);

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Inertia::render('ArtistDetails', [
            'artist' => $this->findArtist($id),
            'favorites' => request()->user()->artists ?? []
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->artistRepository->destroyArtist(auth()->user()->id, $id);
        return Redirect::back();
    }

    /**
     * Find album either in db or api call
     */
    protected function findArtist(string $id): ?array
    {
        // check the db
        $artist = $this->artistRepository->findArtist(auth()->id(), $id);
        if ($artist) {
            return $artist->artist;
        }
        // api check
        return $this->api->artist()->info($id);
    }
}
