<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthServiceInterface;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    /**
     * Redirect to google for authentication
     */
    public function index()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Redirect from google
     */
    public function store(Request $request, AuthServiceInterface $authServiceInterface)
    {
        try {
            $authServiceInterface->loginUsingGoogle(Socialite::driver('google')->user());

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            $authServiceInterface->logout($request);

            return redirect('/');
        }
    }
}
