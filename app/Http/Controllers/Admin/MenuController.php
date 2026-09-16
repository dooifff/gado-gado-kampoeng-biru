<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($search = $request->input('q')) {
            $search = trim($search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $menus = $query->orderBy('category')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.form', ['menu' => new Menu]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => ['required', 'in:Makanan,Minuman'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'is_featured' => ['filled'],
            'is_active' => ['filled'],
        ]);

        $data['image'] = '/images/logo/logo.svg';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image_data'] = base64_encode((string) $file->get());
            $data['image_mime'] = $file->getMimeType();
            $data['image'] = store_image($file, 'menu', $data['name']);
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.form', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'category' => ['required', 'in:Makanan,Minuman'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'is_featured' => ['filled'],
            'is_active' => ['filled'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($menu->image) {
                delete_image($menu->image);
            }
            $data['image'] = store_image($file, 'menu', $data['name']);
            $data['image_data'] = base64_encode((string) $file->get());
            $data['image_mime'] = $file->getMimeType();
        } else {
            unset($data['image'], $data['image_data'], $data['image_mime']);
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        delete_image($menu->image);
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus.');
    }
}