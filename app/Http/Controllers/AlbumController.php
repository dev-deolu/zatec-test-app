<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Services\LastFmService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AddFavouriteAlbumRequest;
use App\Interfaces\AlbumRepositoryInterface;

class AlbumController extends Controller
{

    /**
     * Create a new album controller instance.
     *
     * @param  AlbumRepositoryInterface $albumRepository
     * @return void
     */
    public function __construct(private AlbumRepositoryInterface $albumRepository, private LastFmService $api)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $album = null;
        $request->whenFilled('search', function ($search) use (&$album) {
            $album =  $this->api->album()->search($search);
        }, function () use (&$album) {
            $album = $this->api->album()->search(fake()->realText(10), 15);
        });
        return Inertia::render('Album', [
            'albums' => $album,
            'favorites' => $request->user()->albums ?? []
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        $albumInfo = explode('|', $id);
        return Inertia::render('AlbumDetails', [
            'album' => $this->findAlbum($albumInfo[0], $albumInfo[1]),
            'favorites' => request()->user()->albums ?? []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFavouriteAlbumRequest $request): RedirectResponse
    {
        // check the db
        $album = $this->albumRepository->findByAlbumArtist(auth()->id(), $request->album, $request->artist);
        if ($album) {
            return Redirect::back();
        }
        // api call to get album
        if ($getAlbum = $this->api->album()->info($request->album, $request->artist))
            // store record of album to add to favorite
            $this->albumRepository->createAlbum($request->user()->id, $getAlbum);
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $albumInfo = explode('|', $id);
        $this->albumRepository->destroyAlbum(auth()->user()->id, $albumInfo[0], $albumInfo[1]);
        return Redirect::back();
    }

    /**
     * Find album either in db or api call
     */
    protected function findAlbum(string $albumName, string $albumArtist): ?array
    {
        // check the db
        $album = $this->albumRepository->findByAlbumArtist(auth()->id(), $albumName, $albumArtist);
        if ($album) {
            return $album->album;
        }
        // api check
        return $this->api->album()->info($albumName, $albumArtist);
    }
}
