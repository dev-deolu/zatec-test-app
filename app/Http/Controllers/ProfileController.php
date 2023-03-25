<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Profile', [
            'albums' => request()->user()->albums,
            'artists' => request()->user()->artists,
        ]);
    }
}
