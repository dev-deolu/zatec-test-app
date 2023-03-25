<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Interfaces\AuthServiceInterface;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request, AuthServiceInterface $authServiceInterface)
    {
        $authServiceInterface->login($request);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
