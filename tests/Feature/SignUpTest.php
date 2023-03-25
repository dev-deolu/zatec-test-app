<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignUpTest extends TestCase
{
    use RefreshDatabase;

    public function test_signup_screen_can_be_rendered(): void
    {
        $this->get('/signup')->assertStatus(200)->assertInertia(
            fn (Assert $page) => $page
                ->component('SignUp')
        );
    }

    public function test_new_users_can_signup_using_form(): void
    {
        $this->test_signup_screen_can_be_rendered();
        $response = $this->post('/signup', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_new_users_can_not_signup_using_unconfimed_password(): void
    {
        $this->test_signup_screen_can_be_rendered();
        $response = $this->post('/signup', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'wrong-password',
        ]);
        $this->assertGuest();
    }

    public function test_new_users_can_signup_using_google(): void
    {
        $this->test_signup_screen_can_be_rendered();
        $response = $this->get('/google/login');
        $response->assertFound();

        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn('test user')
            ->shouldReceive('getEmail')
            ->andReturn('test.user' . '@gmail.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);
        $response = $this->get('/google/redirect');
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /**
     * An authenticated user cannot visit register page
     * @return void
     */
    public function test_user_cannot_visit_a_signup_form_when_authenticated()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->actingAs($user)->get('/signup');

        $response->assertRedirect();
    }
}
