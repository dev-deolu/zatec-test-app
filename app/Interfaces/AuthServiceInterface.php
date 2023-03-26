<?php

namespace App\Interfaces;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

interface AuthServiceInterface
{
    /**
     * Register a user
     *
     * @throws ValidationException
     */
    public function register(Request $request): void;

    /**
     * Login a user
     *
     * @throws ValidationException
     */
    public function login(LoginRequest $request): void;

    /**
     * Login a user using Google
     *
     * @throws ValidationException
     */
    public function loginUsingGoogle(\Laravel\Socialite\Contracts\User $googleUser): void;

    /**
     * Logout a user
     */
    public function logout(Request $request): void;
}
