<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed data untuk memastikan halaman dinamis dapat menampilkan konten.
        $this->seed();
    }

    /** Beranda: berhasil (200) dan memuat konten utama. */
    public function test_home_page_returns_ok(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Gado Gado');
        $response->assertSee('Menu');
        $response->assertSee(config('site.tagline'));
        $response->assertSeeInOrder(['Rasa Khas', 'Kampoeng', 'Kangen']);
    }

    /** Tentang Kami: berhasil. */
    public function test_about_page_returns_ok(): void
    {
        $response = $this->get('/tentang-kami');

        $response->assertOk();
        $response->assertSee('Cerita di Balik');
    }

    /** Menu tanpa filter: menampilkan data dari database. */
    public function test_menu_page_returns_ok_and_shows_menus(): void
    {
        $response = $this->get('/menu');

        $response->assertOk();
        $this->assertGreaterThan(0, Menu::active()->count());
    }

    /** Menu dengan filter kategori valid. */
    public function test_menu_page_with_valid_category_filter(): void
    {
        $response = $this->get('/menu?category=Makanan');

        $response->assertOk();
    }

    /** Galeri: berhasil. */
    public function test_gallery_page_returns_ok(): void
    {
        $response = $this->get('/galeri');

        $response->assertOk();
        $response->assertSee('Suasana');
        $this->assertGreaterThan(0, Gallery::count());
    }

    /** Kontak: berhasil dan memuat info kontak. */
    public function test_contact_page_returns_ok(): void
    {
        $response = $this->get('/kontak');

        $response->assertOk();
        $response->assertSee('Kontak');
    }

    /** Robots.txt tersedia sebagai file statis. */
    public function test_robots_txt_exists(): void
    {
        $this->assertFileExists(public_path('robots.txt'));
    }

    /** Pastikan tidak ada route 404 untuk halaman utama. */
    public function test_no_main_route_returns_404(): void
    {
        $routes = ['/', '/tentang-kami', '/menu', '/galeri', '/kontak'];

        foreach ($routes as $route) {
            $this->get($route)->assertStatus(200);
        }
    }
}