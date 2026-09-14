<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            UserSeeder::class,
        ]);

        $this->seedMenus();
        $this->seedGalleries();
        $this->seedTestimonials();
    }

    private function seedMenus(): void
    {
        $menus = [
            ['name' => 'Gado-Gado Kampoeng', 'category' => 'Makanan', 'price' => 15000, 'image' => '/images/menu/gado-gado.svg', 'featured' => true, 'description' => 'Sayuran segar, lontong, dan perkedel dengan siraman bumbu kacang khas kampoeng.'],
            ['name' => 'Lontong Sayur Spesial', 'category' => 'Makanan', 'price' => 15000, 'image' => '/images/menu/lontong-sayur.svg', 'featured' => true, 'description' => 'Lontong lembut dengan kuah santan gurih, telur, dan sambal goreng krecek.'],
            ['name' => 'Nasi Uduk Komplit', 'category' => 'Makanan', 'price' => 18000, 'image' => '/images/menu/nasi-uduk.svg', 'featured' => false, 'description' => 'Nasi uduk wangi lengkap dengan ayam goreng, tempe, sambal, dan lalapan.'],
            ['name' => 'Mie Goreng Kampoeng', 'category' => 'Makanan', 'price' => 15000, 'image' => '/images/menu/mie-goreng.svg', 'featured' => false, 'description' => 'Mie goreng dengan bumbu rempah khas, telur, dan sayuran segar penuh cita rasa.'],
            ['name' => 'Sate Ayam Madura', 'category' => 'Makanan', 'price' => 20000, 'image' => '/images/menu/sate-ayam.svg', 'featured' => true, 'description' => 'Sate ayam empuk dengan bumbu kacang dan sambal yang menggugah selera.'],
            ['name' => 'Soto Ayam Kampoeng', 'category' => 'Makanan', 'price' => 17000, 'image' => '/images/menu/soto-ayam.svg', 'featured' => false, 'description' => 'Soto ayam hangat dengan kuah kuning rempah, bihun, dan seledri segar.'],
            ['name' => 'Es Cendol Biru', 'category' => 'Minuman', 'price' => 10000, 'image' => '/images/menu/es-cendol.svg', 'featured' => true, 'description' => 'Cendol kenyal dengan santan manis dan es serut — segar khas biru kami.'],
            ['name' => 'Es Teh Manis', 'category' => 'Minuman', 'price' => 5000, 'image' => '/images/menu/es-teh.svg', 'featured' => false, 'description' => 'Teh manis segar, pendamping sempurna untuk setiap hidangan.'],
            ['name' => 'Jus Alpukat', 'category' => 'Minuman', 'price' => 12000, 'image' => '/images/menu/jus-alpukat.svg', 'featured' => false, 'description' => 'Alpukat segar dicampur susu cokelat, lembut dan mengenyangkan.'],
            ['name' => 'Kopi Susu Kampoeng', 'category' => 'Minuman', 'price' => 13000, 'image' => '/images/menu/kopi-susu.svg', 'featured' => false, 'description' => 'Kopi lokal diseduh dengan susu, kuat dan nikmat untuk menemani cerita.'],
        ];

        foreach ($menus as $menu) {
            Menu::create([
                'name' => $menu['name'],
                'category' => $menu['category'],
                'price' => $menu['price'],
                'image' => $menu['image'],
                'description' => $menu['description'],
                'is_featured' => $menu['featured'],
                'is_active' => true,
            ]);
        }
    }

    private function seedGalleries(): void
    {
        $galleries = [
            ['title' => 'Gado-Gado Pilihan', 'category' => 'Makanan', 'image' => '/images/gallery/gallery-01.svg'],
            ['title' => 'Sudut Nyaman Warung', 'category' => 'Tempat', 'image' => '/images/gallery/gallery-02.svg'],
            ['title' => 'Meja Penuh Cerita', 'category' => 'Suasana', 'image' => '/images/gallery/gallery-03.svg'],
            ['title' => 'Momen Bersama Keluarga', 'category' => 'Aktivitas', 'image' => '/images/gallery/gallery-04.svg'],
            ['title' => 'Lontong Sayur Hangat', 'category' => 'Makanan', 'image' => '/images/gallery/gallery-05.svg'],
            ['title' => 'Pojok Dekorasi Biru', 'category' => 'Tempat', 'image' => '/images/gallery/gallery-06.svg'],
            ['title' => 'Ramai Jam Makan', 'category' => 'Suasana', 'image' => '/images/gallery/gallery-07.svg'],
            ['title' => 'Senyum Pemilik Warung', 'category' => 'Aktivitas', 'image' => '/images/gallery/gallery-08.svg'],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            ['name' => 'Sari Rahmawati', 'message' => 'Gado-gadonya juara! Bumbu kacangnya kental dan rasanya persis seperti masakan ibu di rumah.', 'rating' => 5],
            ['name' => 'Bagas Prasetyo', 'message' => 'Tempatnya nyaman, harganya bersahabat, dan porsinya pas. Langganan tiap pulang kerja.', 'rating' => 5],
            ['name' => 'Melati Putri', 'message' => 'Es cendolnya paling segar se-kota! Sukses selalu untuk keluarga Kampoeng Biru.', 'rating' => 4],
            ['name' => 'Hendra Wijaya', 'message' => 'Nemu tempat makan khas Indonesia yang bikin kangen kampung halaman. Recommended!', 'rating' => 5],
            ['name' => 'Ratna Dewi', 'message' => 'Rasanya konsisten enak dan pelayanannya ramah. Anak-anak juga suka banget.', 'rating' => 5],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}