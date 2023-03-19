<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function store(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            // find user by email (email is unique to db)
            $user = User::where('email', $googleUser->email)->first();
            if ($user) {
                Auth::login($user);
                return $this->authenticated($request);
            }
            Auth::login($user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make($googleUser->id),
            ]));
            event(new Registered($user));
            return $this->authenticated($request);
        } catch (\Exception $e) {
            logger('google_oauth', ['message' => $e->getMessage()]);
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
    }


    protected function authenticated(Request $request)
    {
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
