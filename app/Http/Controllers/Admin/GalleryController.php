<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $galleries = $query->orderBy('category')->orderBy('title')->paginate(12)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.form', ['gallery' => new Gallery]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'in:Makanan,Tempat,Suasana,Aktivitas'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $data['image'] = store_image($request->file('image'), 'gallery', $data['title']);

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'in:Makanan,Tempat,Suasana,Aktivitas'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            delete_image($gallery->image);
            $data['image'] = store_image($request->file('image'), 'gallery', $data['title']);
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        delete_image($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }
}