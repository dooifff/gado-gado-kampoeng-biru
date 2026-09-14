@extends('layouts.app', [
    'title' => 'Menu — ' . site_setting('name'),
    'meta_description' => 'Jelajahi menu lengkap Gado Gado Kampoeng Biru: gado-gado, lontong sayur, soto, sate, hingga minuman segar seperti es cendol biru.',
])

@section('content')

    {{-- ===== PAGE HERO ===== --}}
    <section class="relative overflow-hidden bg-navy-950 pt-28 pb-16 lg:pt-36 lg:pb-20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 25%, rgba(232,150,51,0.7) 0 2px, transparent 2.5px); background-size: 30px 30px;" aria-hidden="true"></div>
        <div class="container-x relative text-center">
            <p class="eyebrow-light">Menu Kami</p>
            <h1 class="font-display mt-4 text-4xl font-bold tracking-tight text-cream-50 sm:text-5xl">
                Menu &amp; <span class="text-accent-400">Harga</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-navy-200 sm:text-lg">
                Dari hidangan gurih hingga minuman segar — semua diracik dengan bahan berkualitas
                dan cita rasa khas kampoeng.
            </p>
        </div>
    </section>

    {{-- ===== FILTER KATEGORI ===== --}}
    <section class="pt-14 lg:pt-16">
        <div class="container-x">
            <div class="flex flex-wrap items-center justify-center gap-2" role="tablist" aria-label="Filter kategori menu">
                <a
                    href="{{ route('menu') }}"
                    class="{{ is_null($activeCategory) ? 'bg-navy-900 text-white' : 'bg-white text-navy-800 hover:bg-navy-50' }} rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-navy-950/5 transition"
                    aria-current="{{ is_null($activeCategory) ? 'page' : 'false' }}"
                >
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a
                        href="{{ route('menu', ['category' => $category]) }}"
                        class="{{ $activeCategory === $category ? 'bg-navy-900 text-white' : 'bg-white text-navy-800 hover:bg-navy-50' }} rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-navy-950/5 transition"
                        aria-current="{{ $activeCategory === $category ? 'page' : 'false' }}"
                    >
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== DAFTAR MENU ===== --}}
    <section class="py-12 lg:py-14">
        <div class="container-x">
            @if ($menus->isEmpty())
                <div class="mx-auto max-w-md rounded-3xl bg-white p-10 text-center shadow-card">
                    <p class="font-display text-lg font-bold text-navy-950">Belum Ada Menu</p>
                    <p class="mt-2 text-sm text-navy-700/80">
                        Menu untuk kategori ini belum tersedia. Silakan kembali lagi nanti.
                    </p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-reveal>
                    @foreach ($menus as $menu)
                        <x-menu-card :menu="$menu" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $menus->withQueryString()->links() }}
                </div>
            @endif

            <p class="mx-auto mt-16 max-w-2xl text-center text-sm text-navy-700/60">
                Harga dan ketersediaan menu dapat berubah. Untuk pemesanan dalam jumlah banyak
                (nasi box, acara keluarga, dan lainnya), silakan hubungi kami terlebih dahulu.
            </p>
        </div>
    </section>

@endsection