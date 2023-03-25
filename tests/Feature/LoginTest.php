<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $this->get('/login')->assertStatus(200)->assertInertia(
            fn (Assert $page) => $page
                ->component('Login')
        );
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $this->test_login_screen_can_be_rendered();

        $user = $this->create_user('test1@example.com');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_authenticate_using_google(): void
    {
        $this->test_login_screen_can_be_rendered();
        $response = $this->get('/google/login');
        $response->assertFound();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $this->test_login_screen_can_be_rendered();
        $user = $this->create_user('test@example.com');

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
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
