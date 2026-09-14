<?php

namespace App\Support;

use App\Models\Setting;

/**
 * Membaca pengaturan situs dari database, dengan fallback ke config/site.php.
 * Nilai dicache per request agar tidak melakukan query berulang.
 */
class SiteSettings
{
    protected array $cache = [];

    public function get(string $key, mixed $default = null): mixed
    {
        if (array_key_exists($key, $this->cache)) {
            return $this->cache[$key];
        }

        $setting = Setting::query()->where('key', $key)->first();

        return $this->cache[$key] = $setting?->value ?? config("site.{$key}", $default);
    }

    /**
     * Mengembalikan nilai sebagai array. Nilai berupa JSON string di-decode,
     * atau mengembalikan $default bila bukan array.
     */
    public function getArray(string $key, array $default = []): array
    {
        $value = $this->get($key, $default);

        if (is_array($value)) {
            return $value;
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return $default;
    }

    public function remember(string $key, mixed $value): void
    {
        $this->cache[$key] = $value;
    }
}