<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class GoogleIntegrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_google_redirect(): void
    {
        $abstractUser = Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser
            ->shouldReceive('getId')
            ->andReturn(rand())
            ->shouldReceive('getName')
            ->andReturn('test user')
            ->shouldReceive('getEmail')
            ->andReturn('test.user'.'@gmail.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('google')
            ->andReturn($provider);

        $this->get('/google/redirect')
            ->assertRedirect(RouteServiceProvider::HOME);
    }
}
