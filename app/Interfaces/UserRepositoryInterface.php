<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Add a new User
     */
    public function addUser(string $name, string $email, string $password): ?User;

    /**
     * Find user by email
     */
    public function findUserByEmail(string $email): ?User;
}
