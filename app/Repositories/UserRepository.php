<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;

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
            'password' =>  Hash::make($password),
        ]);
    }
}
