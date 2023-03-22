<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = $this->create_user('test@example.com');

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    private function create_user(string $email)
    {
        return User::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => Hash::make('password'),
            'password_confirmation' => 'password',
        ]);
    }
}
