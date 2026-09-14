<?php

use App\Support\SiteSettings;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (! function_exists('site_setting')) {
    /**
     * Membaca pengaturan situs dari database, dengan fallback ke config/site.php.
     */
    function site_setting(string $key, mixed $default = null): mixed
    {
        return app(SiteSettings::class)->get($key, $default);
    }
}

if (! function_exists('site_setting_array')) {
    /**
     * Membaca pengaturan yang berupa array/JSON dari database.
     */
    function site_setting_array(string $key, array $default = []): array
    {
        return app(SiteSettings::class)->getArray($key, $default);
    }
}

if (! function_exists('wa_link')) {
    /**
     * Membuat link WhatsApp wa.me. Mengembalikan null jika nomor customer
     * belum diisi (masih placeholder / kosong).
     */
    function wa_link(?string $message = null): ?string
    {
        $number = preg_replace('/\D+/u', '', (string) site_setting('whatsapp'));

        if ($number === '') {
            return null;
        }

        $text = $message ?? (string) site_setting('wa_message');

        return 'https://wa.me/'.$number.'?text='.rawurlencode($text);
    }
}

if (! function_exists('wa_display')) {
    /**
     * Nomor WhatsApp untuk ditampilkan, atau placeholder '#' yang jelas.
     */
    function wa_display(): string
    {
        return site_setting('wa_display') ?: site_setting('whatsapp');
    }
}

if (! function_exists('site_map_src')) {
    /**
     * URL embed Google Maps, atau null jika data customer belum tersedia.
     */
    function site_map_src(): ?string
    {
        $embed = (string) site_setting('maps_embed');

        if ($embed === '' || Str::startsWith($embed, '[')) {
            return null;
        }

        return $embed;
    }
}

if (! function_exists('site_social_url')) {
    /**
     * URL media sosial yang valid, atau null jika masih placeholder / kosong.
     */
    function site_social_url(string $key): ?string
    {
        $value = (string) site_setting($key);

        if ($value === '' || Str::startsWith($value, '[')) {
            return null;
        }

        return $value;
    }
}

if (! function_exists('store_image')) {
    /**
     * Menyimpan file gambar ke public/images/{dir} dan mengembalikan path-nya.
     */
    function store_image(UploadedFile $file, string $dir, string $prefix = ''): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = Str::slug($prefix).'-'.now()->format('YmdHis').'-'.random_int(1000, 9999).'.'.$extension;

        $file->move(public_path('images/'.$dir), $filename);

        return '/images/'.$dir.'/'.$filename;
    }
}

if (! function_exists('delete_image')) {
    /**
     * Menghapus file gambar dari disk bila memang ada (dan berasal dari public/images).
     */
    function delete_image(?string $path): void
    {
        if ($path && Str::startsWith($path, '/images/')) {
            $absolute = public_path(ltrim($path, '/'));

            if (is_file($absolute)) {
                @unlink($absolute);
            }
        }
    }
}