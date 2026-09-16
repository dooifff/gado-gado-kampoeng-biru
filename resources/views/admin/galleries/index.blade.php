@extends('admin.layouts.app')

@section('title', 'Galeri')

@section('heading', 'Galeri')

@section('actions')
    <a href="{{ route('admin.galleries.create') }}" class="btn-accent !px-5 !py-2.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Foto
    </a>
@endsection

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" action="{{ route('admin.galleries.index') }}" class="flex w-full max-w-sm gap-2">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari judul atau kategori..."
                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
            <button type="submit" class="rounded-xl bg-navy-950 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-navy-800">Cari</button>
        </form>
        <p class="text-sm font-semibold text-navy-700">{{ $galleries->total() }} foto</p>
    </div>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($galleries as $gallery)
            <div class="overflow-hidden rounded-3xl border border-cream-200 bg-white shadow-sm">
                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" onerror="this.onerror=null;this.src='/images/gallery/gallery-01.svg'" class="aspect-[4/3] w-full object-cover">
                <div class="p-5">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h3 class="font-bold text-navy-950">{{ $gallery->title }}</h3>
                            <span class="mt-1 inline-block rounded-full bg-navy-950 px-3 py-1 text-xs font-semibold text-white">{{ $gallery->category }}</span>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-2">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="rounded-lg bg-cream-100 px-4 py-2 text-xs font-bold text-navy-800 transition hover:bg-navy-950 hover:text-white">Edit</a>
                        <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Hapus foto {{ $gallery->title }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-lg bg-red-100 px-4 py-2 text-xs font-bold text-red-700 transition hover:bg-red-600 hover:text-white">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-3xl border border-cream-200 bg-white py-16 text-center text-sm text-navy-700 shadow-sm">
                Belum ada foto galeri. <a href="{{ route('admin.galleries.create') }}" class="font-bold text-accent-600 underline">Tambahkan sekarang</a>.
            </div>
        @endforelse
    </div>

    @if ($galleries->hasPages())
        <div class="mt-6">{{ $galleries->links() }}</div>
    @endif
@endsection