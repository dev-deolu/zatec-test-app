<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AddFavouriteRequest;
use App\Interfaces\AlbumRepositoryInterface;

class AlbumController extends Controller
{

    /**
     * Create a new album controller instance.
     *
     * @param  AlbumRepositoryInterface $albumRepository
     * @return void
     */
    public function __construct(private AlbumRepositoryInterface $albumRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $album = null;
        $request->whenFilled('search', function ($search) use (&$album) {
            $album = $this->search($search);
        }, function () use (&$album) {
            $album = $this->search('forsaken' ?? fake()->realText(10), 15);
        });
        return Inertia::render('Album', [
            'albums' => $album,
            'favorites' => $request->user()->albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $albumInfo = explode('|', $id);
        return Inertia::render('AlbumDetails', [
            'album' => $this->findAlbum($albumInfo[0], $albumInfo[1]),
            'favorites' => request()->user()->albums
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFavouriteRequest $request)
    {
        // check the db
        $album = $this->albumRepository->findByAlbumArtist(auth()->id(), $request->album, $request->artist);
        if ($album) {
            return Redirect::back();
        }
        $this->albumRepository->createAlbum($request->user()->id, $this->showSearch($request->album, $request->artist));
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $albumInfo = explode('|', $id);
        $this->albumRepository->destroyAlbum(auth()->user()->id, $albumInfo[0], $albumInfo[1]);
        return Redirect::back();
    }



    protected function findAlbum($albumName, $albumArtist): ?array
    {
        // check the db
        $album = $this->albumRepository->findByAlbumArtist(auth()->id(), $albumName, $albumArtist);
        if ($album) {
            return $album->album;
        }
        // api check
        return $this->showSearch($albumName, $albumArtist);
    }

    protected function search(string $search, string $limit = '100')
    {
        $response = Http::get('ws.audioscrobbler.com/2.0/', [
            'method' => 'album.search',
            'api_key' => config('services.lastfm.api_key'),
            'format' => 'json',
            'limit' => $limit,
            'album' => $search,
        ]);
        return $response->json()['results']['albummatches']['album'] ?? NULL;
    }

    protected function showSearch(string $albumName, string $albumArtist)
    {
        $response = Http::get('ws.audioscrobbler.com/2.0/', [
            'method' => 'album.getinfo',
            'api_key' => config('services.lastfm.api_key'),
            'format' => 'json',
            'artist' => $albumArtist,
            'album' => $albumName,
        ]);
        return $response->json()['album'] ?? NULL;
    }
}
