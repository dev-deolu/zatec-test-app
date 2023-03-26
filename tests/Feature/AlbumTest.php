<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    use RefreshDatabase;

    public function test_album_screen_can_be_rendered(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->get('/album')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Album')
        );
        $this->assertAuthenticated();
    }

    public function test_unauthenticated_users_con_not_visit_album(): void
    {
        $this->get('/album')->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_can_add_favorite_album()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('album')->post('/album', [
            'id' => 'loveme'.'|'.'Nicoteen Ninyo',
        ])->assertSessionHasNoErrors()->assertFound();
    }

    public function test_user_can_view_favorite_albums(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->from('/album')->post('/album', [
            'id' => 'loveme'.'|'.'Nicoteen Ninyo',
        ])->assertSessionHasNoErrors()->assertFound();
        $this->actingAs($user)->get('/album')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Album')
                ->has('favorites.0')
        );
    }

    public function test_user_can_remove_favorite_album()
    {
        $user = $this->create_user('test@example.com');

        $this->actingAs($user)->from('album')->post('/album', [
            'id' => 'loveme'.'|'.'Nicoteen Ninyo',
        ])->assertSessionHasNoErrors()->assertFound();

        $this->actingAs($user)->get('/album')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Album')
                ->has('favorites.0')
        );
        $this->actingAs($user)->from('album')->delete('/album/'.'loveme'.'|'.'Nicoteen Ninyo')->assertSessionHasNoErrors()->assertFound();
    }

    public function test_user_can_view_albums(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->from('/album')->post('/album', [
            'id' => 'loveme'.'|'.'Nicoteen Ninyo',
        ])->assertSessionHasNoErrors()->assertFound();
        $this->actingAs($user)->from('/album')->get('/album')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('Album')
                ->has('albums')
        );
    }

    public function test_user_can_view_a_album(): void
    {
        $user = $this->create_user('test@example.com');
        $this->actingAs($user)->from('/album')->post('/album', [
            'id' => 'loveme'.'|'.'Nicoteen Ninyo',
        ])->assertSessionHasNoErrors()->assertFound();
        $this->actingAs($user)->from('/album')->get('/album/'.'loveme'.'|'.'Nicoteen Ninyo')->assertOk()->assertInertia(
            fn (Assert $page) => $page
                ->component('AlbumDetails')
                ->hasAll(['album', 'favorites'])
        );
    }

    public function test_users_can_search_for_album()
    {
        $user = $this->create_user('test@example.com');
        $search = 'loveme';

        $response = $this->actingAs($user)->from('/album')->get('/album?search='.$search)->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Album')
                    ->has('albums.0')
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
