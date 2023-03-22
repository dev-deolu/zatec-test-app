<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    public function test_artist_page_is_displayed(): void
    {
        $user = $this->create_user('test@example.com');

        $response = $this
            ->actingAs($user)
            ->get('/artist')
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Artist')
            );

        $response->assertOk();
    }

    public function test_users_can_search_for_artist()
    {
        $user = $this->create_user('test@example.com');
        $search = 'loveme';

        $response =  $this->actingAs($user)->from('/artist')->get('/artist?search=' . $search)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Artist')
                    ->has('artists.0')
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function test_users_can_artist_to_favorite()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('artist')->post('/artist', [
            "id" => 'loveme'
        ])->assertSessionHasNoErrors()
            ->assertFound();
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
