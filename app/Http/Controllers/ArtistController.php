<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Interfaces\ArtistServiceInterface;
use App\Http\Requests\AddFavouriteArtistRequest;

class ArtistController extends Controller
{
    /**
     * Create a new artist controller instance.
     *
     * @param  ArtistServiceInterface $artistService
     * @return void
     */
    public function __construct(private ArtistServiceInterface $artistService)
    {
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        [$artists, $favorites] = $this->artistService->getArtistAndFavoriteWithSearch($request->user(), $request->input('search', null));
        return Inertia::render('Artist', [
            'artists' => $artists,
            'favorites' => $favorites ?? []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddFavouriteArtistRequest $request)
    {
        // check the db
        $this->artistService->addFavoriteArtist($request->user(), $request->id);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $artist)
    {
        $user = request()->user();
        return Inertia::render('ArtistDetails', [
            'artist' => $this->artistService->getArtist($user, $artist),
            'favorites' => $this->artistService->getFavoriteArtists($user)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $artist)
    {
        $this->artistService->removeFavoriteArtist(request()->user(), $artist);
        return Redirect::back();
    }
}
