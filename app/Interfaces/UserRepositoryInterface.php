<?php
namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Add a new User
     */
    public function addUser(string $name, string $email, string $password): ?User;
}
