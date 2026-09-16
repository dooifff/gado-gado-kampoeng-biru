<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_image_served_from_db_blob(): void
    {
        $gallery = Gallery::create([
            'title' => 'Warung',
            'category' => 'Suasana',
            'image' => 'images/gallery/gallery-01.svg',
            'image_data' => base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"><rect width="10" height="10" fill="#E89633"/></svg>'),
            'image_mime' => 'image/svg+xml',
        ]);

        $response = $this->get(route('media.show', ['model' => 'gallery', 'ref' => $gallery->id]));

        $response->assertOk();
        $this->assertSame('image/svg+xml', $response->headers->get('Content-Type'));
    }

    public function test_setting_logo_served_from_db_blob(): void
    {
        Setting::create(['key' => 'logo_data', 'group' => 'general', 'value' => base64_encode('<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"><rect width="8" height="8" fill="#0B1D3A"/></svg>')]);
        Setting::create(['key' => 'logo_mime', 'group' => 'general', 'value' => 'image/svg+xml']);

        $response = $this->get(route('media.show', ['model' => 'setting', 'ref' => 'logo']));

        $response->assertOk();
        $this->assertSame('image/svg+xml', $response->headers->get('Content-Type'));
    }

    public function test_large_upload_stored_in_db(): void
    {
        $this->assertTrue(function_exists('imagecreatetruecolor'), 'Ekstensi PHP GD diperlukan untuk membuat gambar uji besar.');

        $admin = User::factory()->create(['role' => 'admin']);

        $tmpName = tempnam(sys_get_temp_dir(), 'img_uji_');
        $tmpPng = $tmpName . '.png';

        $im = imagecreatetruecolor(1800, 1200);
        for ($y = 0; $y < 1200; $y += 4) {
            imagefilledrectangle($im, 0, $y, 1799, $y + 3, imagecolorallocate($im, ($y * 41) % 256, 170, 60));
            imagefilledrectangle($im, 900, $y, 1799, $y + 1, imagecolorallocate($im, 255 - (($y * 19) % 256), 120, 210));
        }
        imagepng($im, $tmpPng, 0);
        imagedestroy($im);

        $upload = new UploadedFile($tmpPng, basename($tmpPng), 'image/png', null, true);

        $response = $this->actingAs($admin)->post(route('admin.menus.store'), [
            'name' => 'Foto Besar',
            'price' => 25000,
            'description' => 'Uji gambar melebihi 2 MB.',
            'category' => 'Makanan',
            'image' => $upload,
        ]);

        $response->assertRedirect();

        $menu = Menu::where('name', 'Foto Besar')->firstOrFail();
        $this->assertNotNull($menu->image_data);
        $this->assertSame('image/png', $menu->image_mime);
        $this->assertGreaterThan(2 * 1024 * 1024, strlen((string) base64_decode($menu->image_data, true)));

        $this->get($menu->image_url)->assertOk();

        @unlink($tmpPng);
        @unlink($tmpName);
    }
}
