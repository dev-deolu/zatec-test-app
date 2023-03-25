<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Interfaces\AuthServiceInterface;
use Laravel\Socialite\Facades\Socialite;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    /**
     * Create a new signup controller instance.
     *
     * @param  UserRepositoryInterface $userRepository
     * @return void
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Register a user
     * @param Request $request
     *
     * @return void
     * @throws ValidationException
     */
    public function register(Request $request): void
    {
        $user = $this->userRepository->addUser($request->name, $request->email, $request->password);
        if (!$user)
            throw ValidationException::withMessages(['user' => 'error creating user'])->status(406);

        $this->loginUsingUser($user);
    }

    /**
     * Login a user
     * @param LoginRequest $request
     *
     * @return void
     * @throws ValidationException
     */
    public function login(LoginRequest $request): void
    {
        $request->authenticate();

        $request->session()->regenerate();
    }

    public function loginUsingGoogle(\Laravel\Socialite\Contracts\User $googleUser): void
    {
        // find user by email (email is unique to db)
        $user = $this->userRepository->findUserByEmail($googleUser->getEmail());
        if ($user) {
            $this->loginUsingUser($user);
            return;
        }
        $this->loginUsingUser($this->userRepository->addUser($googleUser->getName(), $googleUser->getEmail(), $googleUser->getId()));
    }

    /**
     * Logout a user
     * @param Request $request
     *
     * @return void
     */
    public function logout(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    /**
     * Login using Authenticatable User
     * @param Authenticatable User
     * @return void
     */
    private function loginUsingUser(Authenticatable $user): void
    {
        Auth::login($user);
    }
}
