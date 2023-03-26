<?php

namespace App\Http\Controllers;

use App\Interfaces\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
