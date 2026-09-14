@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('heading', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $stats = [
                ['label' => 'Item Menu', 'value' => $totalMenu, 'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 006 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 006-2.292c.938-.332 1.948-.512 3-.512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25', 'accent' => 'text-accent-600'],
                ['label' => 'Menu Andalan', 'value' => $featuredMenu, 'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z', 'accent' => 'text-accent-600'],
                ['label' => 'Foto Galeri', 'value' => $totalGallery, 'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m0 0h0a5.25 5.25 0 00.75-.75M22.5 12a10.5 10.5 0 11-21 0 10.5 10.5 0 0121 0z', 'accent' => 'text-accent-600'],
                ['label' => 'Testimoni Aktif', 'value' => $activeTestimonial . '/' . $totalTestimonial, 'icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z', 'accent' => 'text-accent-600'],
            ];
        @endphp
        @foreach ($stats as $stat)
            <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-navy-700">{{ $stat['label'] }}</p>
                        <p class="mt-1 font-display text-3xl font-bold text-navy-950">{{ $stat['value'] }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 {{ $stat['accent'] }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 font-display text-lg font-bold text-navy-950">Aksi Cepat</h2>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.menus.create') }}" class="rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3 text-center text-sm font-semibold text-navy-800 transition hover:border-accent-500 hover:text-accent-600">+ Tambah Menu</a>
                <a href="{{ route('admin.galleries.create') }}" class="rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3 text-center text-sm font-semibold text-navy-800 transition hover:border-accent-500 hover:text-accent-600">+ Tambah Foto</a>
                <a href="{{ route('admin.testimonials.create') }}" class="rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3 text-center text-sm font-semibold text-navy-800 transition hover:border-accent-500 hover:text-accent-600">+ Tambah Testimoni</a>
                @if (auth()->user()->isOwner())
                    <a href="{{ route('admin.settings.index') }}" class="rounded-2xl border border-cream-200 bg-cream-50 px-4 py-3 text-center text-sm font-semibold text-navy-800 transition hover:border-accent-500 hover:text-accent-600">Atur Situs</a>
                @endif
            </div>
        </div>

        <div class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="mb-4 font-display text-lg font-bold text-navy-950">Testimoni Terbaru</h2>
            @forelse ($recentTestimonials as $testimonial)
                <div class="flex items-start gap-4 border-b border-cream-100 py-4 last:border-0">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy-950 text-sm font-bold text-white">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex flex-wrap items-center justify-between gap-x-3">
                            <p class="text-sm font-bold text-navy-950">{{ $testimonial->name }}</p>
                            <span class="text-sm text-amber-500" aria-label="Rating {{ $testimonial->rating }} dari 5">★ {{ $testimonial->rating }}/5</span>
                        </div>
                        <p class="mt-1 line-clamp-2 text-sm text-navy-700">{{ $testimonial->message }}</p>
                    </div>
                </div>
            @empty
                <p class="py-6 text-center text-sm text-navy-700">Belum ada testimoni.</p>
            @endforelse
        </div>
    </div>
@endsection