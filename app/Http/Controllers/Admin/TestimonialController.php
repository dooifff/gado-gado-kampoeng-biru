<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->latest()->paginate(12)->withQueryString();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'is_active' => ['filled'],
        ]);

        $data['image'] = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image_data'] = base64_encode((string) $file->get());
            $data['image_mime'] = $file->getMimeType();
            $data['image'] = store_image($file, 'testimonials', $data['name']);
        }

        $data['is_active'] = $request->boolean('is_active');

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:1000'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'is_active' => ['filled'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            delete_image($testimonial->image);
            $data['image'] = store_image($file, 'testimonials', $data['name']);
            $data['image_data'] = base64_encode((string) $file->get());
            $data['image_mime'] = $file->getMimeType();
        } else {
            unset($data['image'], $data['image_data'], $data['image_mime']);
        }

        $data['is_active'] = $request->boolean('is_active');

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        delete_image($testimonial->image);
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}