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

    public function test_artist_screen_can_be_rendered(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->get('/artist')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Artist')
        );
        $this->assertAuthenticated();
    }

    public function test_unauthenticated_users_con_not_visit_artist(): void
    {
        $this->get('/artist')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_can_add_favorite_artist()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('artist')->post('/artist', [
            "id" => 'loveme'
        ])->assertSessionHasNoErrors()->assertFound();
    }



    public function test_user_can_view_favorite_artists(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->from('/artist')->post('/artist', [
            "id" => 'loveme'
        ])->assertSessionHasNoErrors()->assertFound();
        $this->actingAs($user)->get('/artist')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Artist')
                ->has('favorites.0')
        );
    }

    public function test_user_can_remove_favorite_artist()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('artist')->post('/artist', [
            "id" => 'loveme'
        ])->assertSessionHasNoErrors()->assertFound();

        $this->actingAs($user)->get('/artist')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Artist')
                ->has('favorites.0')
        );
        $this->actingAs($user)->from('artist')->delete('/artist/loveme')->assertSessionHasNoErrors()->assertFound();
    }

    public function test_user_can_view_artists(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->from('/artist')->post('/artist', [
            "id" => 'loveme'
        ])->assertSessionHasNoErrors()->assertFound();
        $this->actingAs($user)->from('/artist')->get('/artist')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Artist')
                ->has('artists')
        );
    }

    public function test_users_can_search_for_artist()
    {
        $user = $this->create_user('test@example.com');
        $search = 'loveme';

        $response =  $this->actingAs($user)->from('/artist')->get('/artist?search=' . $search)->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Artist')
                    ->has('artists.0')
            );

        $response->assertSessionHasNoErrors()->assertOk();
    }



    private function create_user(string $email)
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => Hash::make('password'),
            'password_confirmation' => 'password',
        ]);
        return $user;
    }
}
