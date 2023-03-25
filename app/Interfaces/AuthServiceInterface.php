<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

interface AuthServiceInterface
{

    /**
     * Register a user
     * @param Request $request
     *
     * @return void
     * @throws ValidationException
     */
    public function register(Request $request): void;

    /**
     * Login a user
     * @param LoginRequest $request
     *
     * @return void
     * @throws ValidationException
     */
    public function login(LoginRequest $request): void;

    /**
     * Login a user using Google
     * @param \Laravel\Socialite\Contracts\User $googleUser
     *
     * @return void
     * @throws ValidationException
     */
    public function loginUsingGoogle(\Laravel\Socialite\Contracts\User $googleUser): void;

    /**
     * Logout a user
     * @param Request $request
     *
     * @return void
     */
    public function logout(Request $request): void;
}
