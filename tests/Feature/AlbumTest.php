<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    public function test_album_page_is_displayed(): void
    {
        $user = $this->create_user('test@example.com');

        $response = $this
            ->actingAs($user)
            ->get('/album')
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Album')
            );;

        $response->assertOk();
    }

    public function test_users_can_search_for_albums()
    {
        $user = $this->create_user('test@example.com');
        $search = 'loveme';

        $response =  $this->actingAs($user)->from('/album')->get('/album?search=' . $search)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Album')
                    ->has('albums.0')
            );

        $response
            ->assertSessionHasNoErrors()
            ->assertOk();
    }

    public function test_users_can_album_to_favorite()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('album')->post('/album', [
            "id" => 'loveme' . '|' . 'Nicoteen Ninyo'
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
