<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteUser;
use Tests\TestCase;

class GoogleLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_google_redirect_route_returns_302(): void
    {
        Socialite::fake('google');

        $this->get(route('login.google'))
            ->assertStatus(302);
    }

    public function test_google_callback_creates_customer_and_logs_in(): void
    {
        Socialite::fake('google', SocialiteUser::fake([
            'id'    => 'google-id-999',
            'name'  => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'token' => 'token-abc',
            'refreshToken' => 'refresh-abc',
            'expiresIn' => 3600,
        ]));

        $this->get(route('login.google.callback'))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email'     => 'budi@gmail.com',
            'name'      => 'Budi Santoso',
            'google_id' => 'google-id-999',
            'role'      => 'customer',
        ]);

        $this->assertAuthenticated();
    }

    public function test_google_callback_links_to_existing_user_by_email(): void
    {
        $existing = \App\Models\User::factory()->create([
            'email'    => 'sari@gmail.com',
            'role'     => 'customer',
            'password' => 'password123',
        ]);

        Socialite::fake('google', SocialiteUser::fake([
            'id'    => 'google-id-222',
            'name'  => 'Sari',
            'email' => 'sari@gmail.com',
        ]));

        $this->get(route('login.google.callback'))
            ->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'id'        => $existing->id,
            'google_id' => 'google-id-222',
        ]);

        $this->assertAuthenticatedAs($existing);
    }
}
