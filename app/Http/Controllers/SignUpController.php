<?php

namespace App\Http\Controllers;


use Inertia\Inertia;
use App\Http\Requests\SignUpRequest;
use App\Interfaces\AuthServiceInterface;
use App\Providers\RouteServiceProvider;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SignUp');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SignUpRequest $request, AuthServiceInterface $authServiceInterface)
    {
        $authServiceInterface->register($request);
        return redirect(RouteServiceProvider::HOME);
    }
}
