@extends('admin.layouts.app')

@section('title', $menu->exists ? 'Edit Menu' : 'Tambah Menu')

@section('heading', $menu->exists ? 'Edit Menu' : 'Tambah Menu')

@section('content')
    <form method="POST" action="{{ $menu->exists ? route('admin.menus.update', $menu) : route('admin.menus.store') }}" enctype="multipart/form-data"
        class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @if ($menu->exists)
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
                <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Informasi Menu</h2>
                <div class="space-y-5">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-semibold text-navy-800">Nama Menu <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}" required maxlength="150"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="category" class="mb-1.5 block text-sm font-semibold text-navy-800">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" id="category" required class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                                @foreach (['Makanan', 'Minuman'] as $category)
                                    <option value="{{ $category }}" @selected(old('category', $menu->category) === $category)>{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="price" class="mb-1.5 block text-sm font-semibold text-navy-800">Harga (Rp) <span class="text-red-500">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $menu->price) }}" required min="0" step="500"
                                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-navy-800">Deskripsi</label>
                        <textarea name="description" id="description" rows="4" maxlength="1000"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">{{ old('description', $menu->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="flex items-center gap-3 rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $menu->is_featured)) class="h-5 w-5 rounded border-cream-300 text-accent-500 focus:ring-accent-500">
                            <span class="text-sm font-semibold text-navy-800">Menu andalan (tampil di beranda)</span>
                        </label>
                        <label class="flex items-center gap-3 rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3">
                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $menu->is_active ?? true)) class="h-5 w-5 rounded border-cream-300 text-accent-500 focus:ring-accent-500">
                            <span class="text-sm font-semibold text-navy-800">Tampilkan di situs</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.menus.index') }}" class="rounded-xl border border-cream-300 bg-white px-6 py-3 text-sm font-bold text-navy-800 transition hover:bg-cream-50">Batal</a>
                <button type="submit" class="btn-accent !px-8 !py-3">{{ $menu->exists ? 'Simpan Perubahan' : 'Simpan Menu' }}</button>
            </div>
        </div>

        <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm lg:self-start">
            <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Foto Menu</h2>
            <div x-data="{ preview: @js($menu->image ? $menu->image_url : null) }">
                <img :src="preview ?? '/images/logo/logo.svg'" alt="Pratinjau foto menu" class="aspect-square w-full rounded-2xl border border-cream-200 bg-cream-50 object-cover">
                <input type="file" name="image" id="image" accept="image/*"
                    @change="const f = $event.target.files[0]; if (f) { const r = new FileReader(); r.onload = e => preview = e.target.result; r.readAsDataURL(f); }"
                    class="mt-4 w-full text-sm text-navy-700 file:mr-3 file:rounded-xl file:border-0 file:bg-navy-950 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-white hover:file:bg-navy-800">
                <p class="mt-2 text-xs text-navy-700">JPG, PNG, WEBP, atau SVG. Maks 10 MB. Kosongkan untuk mempertahankan foto saat ini.</p>
            </div>
        </div>
    </form>
@endsection