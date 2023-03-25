<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_screen_can_be_rendered(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->get('/profile')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Profile')
        );
        $this->assertAuthenticated();
    }

    public function test_unauthenticated_users_con_not_visit_profile(): void
    {
        $this->get('/profile')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_profile_can_view_favorite_artists(): void
    {
        $user = $this->create_user('test@example.com');
        $user->loadMissing('artists');
        $instance = Assert::fromTestResponse($this->actingAs($user)->get('/profile'));

        $this->actingAs($user)->get('/profile')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Profile')
                ->has('artists')
        );
    }

    public function test_profile_can_view_favorite_albums(): void
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->get('/profile')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Profile')
                ->has('albums')
        );
    }

    private function create_user(string $email)
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => Hash::make('password'),
            'password_confirmation' => 'password',
        ]);
        $this->actingAs($user)->post('/artist', [
            "id" => 'loveme'
        ])->assertStatus(302);

        $this->actingAs($user)->post('/album', [
            "id" => 'loveme' . '|' . 'Nicoteen Ninyo'
        ])->assertStatus(302);
        return $user;
    }
}
