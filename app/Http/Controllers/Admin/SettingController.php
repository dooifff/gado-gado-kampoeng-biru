<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $fields = [
        'name', 'tagline', 'description',
        'address', 'city', 'email',
        'whatsapp', 'wa_display', 'wa_message',
        'instagram', 'facebook', 'tiktok',
        'maps_embed',
    ];

    protected array $imageFields = ['logo', 'hero', 'about'];

    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'tagline' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:1000'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'wa_display' => ['nullable', 'string', 'max:50'],
            'wa_message' => ['nullable', 'string', 'max:500'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'maps_embed' => ['nullable', 'string', 'max:2000'],
            'hours_day' => ['required', 'array'],
            'hours_day.*' => ['required', 'string', 'max:100'],
            'hours_time' => ['required', 'array'],
            'hours_time.*' => ['required', 'string', 'max:100'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'hero' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'about' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
        ]);

        foreach ($this->fields as $key) {
            if (array_key_exists($key, $data)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $data[$key], 'group' => 'general']);
            }
        }

        $this->saveImage($request);

        $hours = [];
        foreach ($data['hours_day'] as $index => $day) {
            $hours[] = ['day' => $day, 'time' => $data['hours_time'][$index] ?? ''];
        }
        Setting::updateOrCreate(['key' => 'hours'], ['value' => json_encode($hours), 'group' => 'general']);

        return back()->with('success', 'Pengaturan situs berhasil disimpan.');
    }

    protected function saveImage(Request $request): void
    {
        foreach ($this->imageFields as $key) {
            if (! $request->hasFile($key)) {
                continue;
            }

            $file = $request->file($key);

            $old = Setting::where('key', $key)->value('value');
            if ($old) {
                delete_image($old);
            }

            $path = store_image($file, 'settings', $key);

            Setting::updateOrCreate(['key' => $key], ['value' => $path, 'group' => 'general']);
            Setting::updateOrCreate(['key' => $key . '_data'], ['value' => base64_encode((string) $file->get()), 'group' => 'general']);
            Setting::updateOrCreate(['key' => $key . '_mime'], ['value' => $file->getMimeType(), 'group' => 'general']);
        }
    }
}