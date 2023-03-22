<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/signup');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/signup', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * An authenticated user cannot visit register page
     * @return void
     */
    public function test_user_cannot_visit_a_register_form_when_authenticated()
    {
        $user = \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->actingAs($user)->get('/signup');

        $response->assertRedirect();
    }
}
