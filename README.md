# Gado Gado Kampoeng Biru

Website company profile untuk bisnis kuliner **Gado Gado Kampoeng Biru** — modern, elegan, responsive, dan siap dikembangkan.

Dibangun dengan **Laravel 10 + Blade + Tailwind CSS + Alpine.js + MySQL + Vite**.

## Fitur

- 5 halaman: Home, Tentang Kami, Menu, Galeri, Kontak (semua memakai named routes)
- Data menu, galeri, dan testimoni dinamis dari database
- Filter kategori menu/galeri (`?category=`) + pagination
- Galeri lightbox dan carousel testimoni dengan Alpine.js
- Navbar sticky dengan scroll state + mobile menu animasi
- Pesan langsung via WhatsApp (wa.me) — otomatis aktif setelah nomor diisi
- Google Maps embed — otomatis tampil setelah URL diisi
- SEO: meta description, canonical, Open Graph, JSON-LD Restaurant, `robots.txt`
- Aksesibilitas: skip-link, aria-label, focus ring, kontras memadai, `prefers-reduced-motion`
- Animasi reveal-on-scroll ringan (fade-in / slide-up) yang tetap terlihat jika JavaScript gagal dimuat
- Test otomatis PHPUnit untuk seluruh halaman

## Kebutuhan Sistem

- PHP **^8.1**
- Composer 2
- Node.js + npm
- MySQL 8 (atau server MySQL lain yang kompatibel)

## Instalasi

```bash
composer install
npm install
cp .env.example .env        # lalu sesuaikan konfigurasi database di .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

Pengaturan database di `.env`:

```dotenv
APP_NAME="Gado Gado Kampoeng Biru"
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gado_gado_kampoeng_biru
DB_USERNAME=root
DB_PASSWORD=
```

## Menjalankan

Development:

```bash
npm run dev
php artisan serve
```

Production build:

```bash
npm run build
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

Akses `http://127.0.0.1:8000` (atau port sesuai `php artisan serve`).

## Menjalankan Test

Test memakai SQLite in-memory sehingga tidak menyentuh database utama:

```bash
php artisan test
```

## Mengganti Data Customer

Seluruh data bisnis (alamat, WhatsApp, Instagram, email, jam operasional, Google Maps) tersimpan
terpusat di **`config/site.php`** sebagai placeholder. Saat data asli tersedia, cukup edit file itu:

- `whatsapp` → isi nomor (contoh `6281234567890`). Tombol "Pesan Sekarang", "Pesan via WhatsApp",
  dan form pesan di halaman Kontak otomatis aktif.
- `maps_embed` → isi URL embed Google Maps. Peta otomatis muncul di Home & Kontak.
- `instagram`, `facebook`, `tiktok`, `email` → ikon media sosial otomatis tampil bila diisi.
- Setelah alamat + WhatsApp terisi, JSON-LD structured data (Restaurant) di halaman Home aktif untuk SEO.

Foto asli customer: ganti file di `public/images/` (logo, hero, about, menu, gallery) dengan nama
yang sudah ada, atau ubah path di `config/site.php` / seeder.

Dummy data dari seeder dapat dihapus kapan saja:

```bash
php artisan migrate:fresh --seed=false
```

## Struktur Folder

```
gado-gado-kampoeng-biru/
├── app/
│   ├── Http/Controllers/    # Home, About, Menu, Gallery, Contact
│   ├── Models/              # Menu, Gallery, Testimonial
│   └── helpers.php          # wa_link(), site_map_src(), dll.
├── config/site.php          # DATA CUSTOMER
├── database/
│   ├── migrations/          # menus, galleries, testimonials
│   └── seeders/DatabaseSeeder.php
├── public/
│   ├── images/              # logo, hero, about, menu, gallery
│   └── favicon.png, robots.txt
├── resources/
│   ├── css/app.css          # Tailwind + komponen kelas (btn, card, dst.)
│   ├── js/app.js            # Alpine + reveal-on-scroll
│   └── views/
│       ├── layouts/app.blade.php
│       ├── components/      # navbar, footer, menu-card, gallery-card,
│       │                    # testimonial-card, section-heading, map-embed
│       ├── home.blade.php / about.blade.php / menu.blade.php
│       ├── gallery.blade.php / contact.blade.php
├── routes/web.php
└── tests/Feature/PageTest.php
```

## Pengembangan Selanjutnya

Struktur sudah disiapkan agar mudah ditambahkan di masa depan tanpa mengubah fondasi:

- Admin panel: login admin, dashboard, CRUD menu/galeri/testimoni, pengaturan website
- Online ordering, booking, sistem pembayaran, contact form

Fitur tersebut sengaja **tidak** dibangun pada versi pertama sesuai master brief.