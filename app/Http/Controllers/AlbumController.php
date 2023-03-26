<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFavouriteAlbumRequest;
use App\Interfaces\AlbumServiceInterface;
use App\Traits\AlbumTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AlbumController extends Controller
{
    use AlbumTrait;

    /**
     * Create a new album controller instance.
     */
    public function __construct(private AlbumServiceInterface $albumService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        [$albums, $favorites] = $this->albumService->getAlbumAndFavoriteWithSearch($request->user(), $request->input('search', null));

        return Inertia::render('Album', [
            'albums' => $albums,
            'favorites' => $favorites ?? [],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        [$album, $artist] = $this->getAlbumAndArtistFromId($id);
        $user = request()->user();

        return Inertia::render('AlbumDetails', [
            'album' => $this->albumService->getAlbum($user, $album, $artist),
            'favorites' => $this->albumService->getFavoriteAlbums($user),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFavouriteAlbumRequest $request): RedirectResponse
    {
        // check the db
        $album = $this->albumService->addFavoriteAlbum($request->user(), $request->album, $request->artist);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        [$album, $artist] = $this->getAlbumAndArtistFromId($id);
        $this->albumService->removeFavoriteAlbum(auth()->user(), $album, $artist);

        return Redirect::back();
    }
}
