<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\AuthServiceInterface;

class LogoutController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request, AuthServiceInterface $authServiceInterface): RedirectResponse
    {
        $authServiceInterface->logout($request);
        return redirect('/');
    }
}
