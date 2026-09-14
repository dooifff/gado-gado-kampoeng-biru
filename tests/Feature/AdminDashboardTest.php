<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function seedOwner(): User
    {
        return User::create([
            'name' => 'Owner',
            'email' => 'owner@example.test',
            'password' => bcrypt('owner12345'),
            'role' => 'owner',
        ]);
    }

    protected function seedAdmin(): User
    {
        return User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => bcrypt('admin12345'),
            'role' => 'admin',
        ]);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/menus')->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_access_dashboard(): void
    {
        $this->seedAdmin();

        $this->post('/admin/login', [
            'email' => 'admin@example.test',
            'password' => 'admin12345',
        ])->assertRedirect('/admin');

        $this->get('/admin')->assertSuccessful()->assertSee('Dashboard');
    }

    public function test_login_fails_with_wrong_credentials(): void
    {
        $this->seedAdmin();

        $this->post('/admin/login', [
            'email' => 'admin@example.test',
            'password' => 'salah',
        ])->assertSessionHasErrors('email');
    }

    public function test_admin_cannot_access_owner_settings(): void
    {
        $this->actingAs($this->seedAdmin());

        $this->get('/admin/settings')->assertForbidden();
        $this->post('/admin/settings', [])->assertForbidden();
    }

    public function test_owner_can_access_settings(): void
    {
        $this->actingAs($this->seedOwner());

        $this->get('/admin/settings')->assertSuccessful()->assertSee('Jam Operasional');
    }

    public function test_owner_can_update_settings(): void
    {
        $this->actingAs($this->seedOwner());

        $response = $this->post('/admin/settings', [
            'name' => 'Gado Gado Baru',
            'tagline' => 'Tagline Baru',
            'description' => 'Deskripsi baru warung.',
            'address' => 'Jl. Contoh No. 1',
            'city' => 'Jakarta',
            'hours_day' => ['Senin – Jumat'],
            'hours_time' => ['10.00 – 21.00 WIB'],
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('settings', ['key' => 'name', 'value' => 'Gado Gado Baru']);
        $this->assertDatabaseHas('settings', ['key' => 'tagline', 'value' => 'Tagline Baru']);
    }

    public function test_admin_can_create_menu(): void
    {
        $this->actingAs($this->seedAdmin());

        $this->post('/admin/menus', [
            'name' => 'Nasi Goreng Spesial',
            'category' => 'Makanan',
            'price' => 18000,
            'description' => 'Pedas nikmat.',
            'is_active' => '1',
        ])->assertRedirect('/admin/menus')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('menus', [
            'name' => 'Nasi Goreng Spesial',
            'price' => 18000,
            'is_active' => true,
        ]);
    }

    public function test_guest_cannot_login_with_public_route(): void
    {
        $this->assertFalse(auth()->check());
    }
}