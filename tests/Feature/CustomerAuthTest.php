<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_is_accessible(): void
    {
        $this->get('/login')->assertSuccessful()->assertSee('Masuk Pelanggan');
    }

    public function test_register_page_is_accessible(): void
    {
        $this->get('/register')->assertSuccessful()->assertSee('Buat Akun Baru');
    }

    public function test_customer_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.test',
            'password' => 'rahasia1234',
            'password_confirmation' => 'rahasia1234',
        ]);

        $response->assertRedirect('/')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'email' => 'budi@example.test',
            'role' => 'customer',
        ]);

        $this->assertAuthenticated();
    }

    public function test_customer_can_login_and_logout(): void
    {
        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.test',
            'password' => 'rahasia1234',
            'role' => 'customer',
        ]);

        $this->post('/login', [
            'email' => 'siti@example.test',
            'password' => 'rahasia1234',
        ])->assertRedirect('/');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'siti@example.test', 'role' => 'customer']);

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_login_fails_with_wrong_password(): void
    {
        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.test',
            'password' => 'rahasia1234',
            'role' => 'customer',
        ]);

        $this->post('/login', [
            'email' => 'siti@example.test',
            'password' => 'salah12345',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_user_is_redirected_away_from_login(): void
    {
        $user = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.test',
            'password' => 'rahasia1234',
            'role' => 'customer',
        ]);

        $this->actingAs($user)->get('/login')->assertRedirect('/');
        $this->actingAs($user)->get('/register')->assertRedirect('/');
    }
}