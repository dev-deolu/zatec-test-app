<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
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
    public function store(SignUpRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
