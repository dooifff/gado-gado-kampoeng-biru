<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BackfillImageData extends Command
{
    protected $signature = 'images:backfill';

    protected $description = 'Menyalin byte file gambar di public/images ke kolom image_data mengisi database.';

    public function handle(): int
    {
        $count = 0;

        foreach (Menu::all() as $model) {
            if ($this->snapshot($model, 'image')) {
                $count++;
            }
        }

        foreach (Gallery::all() as $model) {
            if ($this->snapshot($model, 'image')) {
                $count++;
            }
        }

        foreach (Testimonial::all() as $model) {
            if ($this->snapshot($model, 'image')) {
                $count++;
            }
        }

        foreach (['logo', 'hero', 'about'] as $ref) {
            if ($this->snapshotSetting($ref)) {
                $count++;
            }
        }

        $this->info("Selesai. {$count} gambar disalin ke database.");

        return self::SUCCESS;
    }

    protected function snapshot($model, string $column): bool
    {
        if ($model->image_data !== null && $model->image_data !== '') {
            return false;
        }

        $relative = (string) $model->{$column};

        if ($relative === '' || Str::startsWith($relative, 'http') || Str::startsWith($relative, 'data:')) {
            return false;
        }

        $absolute = public_path(ltrim($relative, '/'));

        if (! is_file($absolute)) {
            return false;
        }

        $model->image_data = base64_encode((string) file_get_contents($absolute));
        $model->image_mime = 'image/svg+xml';
        $model->save();

        return true;
    }

    protected function snapshotSetting(string $ref): bool
    {
        if (Setting::where('key', $ref.'_data')->exists()) {
            return false;
        }

        $absolute = public_path('images/'.$ref.'/'.$ref.'.svg');

        if (! is_file($absolute)) {
            return false;
        }

        Setting::updateOrCreate(
            ['key' => $ref.'_data', 'group' => 'general'],
            ['value' => base64_encode((string) file_get_contents($absolute))],
        );
        Setting::updateOrCreate(
            ['key' => $ref.'_mime', 'group' => 'general'],
            ['value' => 'image/svg+xml'],
        );

        return true;
    }
}
