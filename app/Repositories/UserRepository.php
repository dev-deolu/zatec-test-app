<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Add a new User
     */
    public function addUser(string $name, string $email, string $password): ?User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    /**
     * Find user by email
     */
    public function findUserByEmail(string $email): ?User
    {
        return  User::where('email', $email)->first();
    }
}
