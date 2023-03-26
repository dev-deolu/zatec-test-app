<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    /**
     * Create a new signup controller instance.
     *
     * @return void
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * Register a user
     *
     * @throws ValidationException
     */
    public function register(Request $request): void
    {
        $user = $this->userRepository->addUser($request->name, $request->email, $request->password);
        if (! $user) {
            throw ValidationException::withMessages(['user' => 'error creating user'])->status(406);
        }

        $this->loginUsingUser($user);
    }

    /**
     * Login a user
     *
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
     */
    public function logout(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    /**
     * Login using Authenticatable User
     *
     * @param Authenticatable User
     */
    private function loginUsingUser(Authenticatable $user): void
    {
        Auth::login($user);
    }
}
