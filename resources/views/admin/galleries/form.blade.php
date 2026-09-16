@extends('admin.layouts.app')

@section('title', $gallery->exists ? 'Edit Foto' : 'Tambah Foto')

@section('heading', $gallery->exists ? 'Edit Foto' : 'Tambah Foto')

@section('content')
    <form method="POST" action="{{ $gallery->exists ? route('admin.galleries.update', $gallery) : route('admin.galleries.store') }}" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @if ($gallery->exists)
            @method('PUT')
        @endif

        <div class="space-y-6 lg:col-span-2">
            @if ($errors->any())
                <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700" role="alert">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <div class="space-y-5">
                    <div>
                        <label for="title" class="mb-1.5 block text-sm font-semibold text-navy-800">Judul Foto <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" required maxlength="150"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                    </div>

                    <div>
                        <label for="category" class="mb-1.5 block text-sm font-semibold text-navy-800">Kategori <span class="text-red-500">*</span></label>
                        <select name="category" id="category" required class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                            @foreach (['Makanan', 'Tempat', 'Suasana', 'Aktivitas'] as $category)
                                <option value="{{ $category }}" @selected(old('category', $gallery->category) === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.galleries.index') }}" class="rounded-xl border border-cream-300 bg-white px-6 py-3 text-sm font-bold text-navy-800 transition hover:bg-cream-50">Batal</a>
                <button type="submit" class="btn-accent !px-8 !py-3">{{ $gallery->exists ? 'Simpan Perubahan' : 'Simpan Foto' }}</button>
            </div>
        </div>

        <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm lg:self-start">
            <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Foto</h2>
            <div x-data="{ preview: @js($gallery->image ? $gallery->image_url : null) }">
                <img :src="preview ?? '/images/logo/logo.svg'" alt="Pratinjau foto galeri" class="aspect-[4/3] w-full rounded-2xl border border-cream-200 bg-cream-50 object-cover">
                <input type="file" name="image" id="image" accept="image/*" {{ $gallery->exists ? '' : 'required' }}
                    @change="const f = $event.target.files[0]; if (f) { const r = new FileReader(); r.onload = e => preview = e.target.result; r.readAsDataURL(f); }"
                    class="mt-4 w-full text-sm text-navy-700 file:mr-3 file:rounded-xl file:border-0 file:bg-navy-950 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-white hover:file:bg-navy-800">
                <p class="mt-2 text-xs text-navy-700">JPG, PNG, WEBP, atau SVG. Maks 10 MB.{{ $gallery->exists ? ' Kosongkan untuk mempertahankan foto saat ini.' : '' }}</p>
            </div>
        </div>
    </form>
@endsection