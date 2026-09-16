<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class MediaController extends Controller
{
    /**
     * Menyajikan gambar yang tersimpan di database (image_data BLOB).
     */
    public function show(Request $request, string $model, string $ref): Response
    {
        [$data, $mime] = $this->resolve($model, $ref);

        if ($data === null || $data === '') {
            return $this->fallback($request, $model, $ref);
        }

        $binary = base64_decode($data, true);

        if ($binary === false || $binary === '') {
            return $this->fallback($request, $model, $ref);
        }

        return response($binary, 200, [
            'Content-Type' => $mime ?: 'application/octet-stream',
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }

    protected function resolve(string $model, string $ref): array
    {
        return match ($model) {
            'menu' => $this->fromModel(Menu::query()->find((int) $ref)),
            'gallery' => $this->fromModel(Gallery::query()->find((int) $ref)),
            'testimonial' => $this->fromModel(Testimonial::query()->find((int) $ref)),
            'setting' => $this->fromSetting($ref),
            default => [null, null],
        };
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    protected function fromModel($model): array
    {
        return $model ? [$model->image_data, $model->image_mime] : [null, null];
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    protected function fromSetting(string $ref): array
    {
        $data = Setting::where('key', $ref . '_data')->value('value');
        $mime = Setting::where('key', $ref . '_mime')->value('value');

        return [$data, $mime];
    }

    protected function fallback(Request $request, string $model, string $ref): Response
    {
        $defaults = [
            'menu' => '/images/logo/logo.svg',
            'gallery' => '/images/gallery/gallery-01.svg',
            'testimonial' => '/images/logo/logo.svg',
            'setting' => '/images/'.$ref.'/'.$ref.'.svg',
        ];

        $path = $defaults[$model] ?? '/images/logo/logo.svg';

        $absolute = public_path(ltrim($path, '/'));

        if (! is_file($absolute)) {
            abort(404);
        }

        return response(file_get_contents($absolute), 200, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}