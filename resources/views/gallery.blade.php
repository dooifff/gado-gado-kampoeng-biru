@extends('layouts.app', [
    'title' => 'Galeri — ' . site_setting('name'),
    'meta_description' => 'Galeri foto Gado Gado Kampoeng Biru: menu andalan, suasana warung, dan momen hangat bersama pelanggan.',
])

@section('content')

    {{-- ===== PAGE HERO ===== --}}
    <section class="relative overflow-hidden bg-navy-950 pt-28 pb-16 lg:pt-36 lg:pb-20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 75% 25%, rgba(232,150,51,0.7) 0 2px, transparent 2.5px); background-size: 30px 30px;" aria-hidden="true"></div>
        <div class="container-x relative text-center">
            <p class="eyebrow-light">Galeri</p>
            <h1 class="font-display mt-4 text-4xl font-bold tracking-tight text-cream-50 sm:text-5xl">
                Suasana, Makanan, &amp; <span class="text-accent-400">Momen</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-navy-200 sm:text-lg">
                Sebuah album kecil berisi makanan, tempat, dan kenangan hangat bersama pelanggan.
            </p>
        </div>
    </section>

    {{-- ===== FILTER KATEGORI ===== --}}
    <section class="pt-14 lg:pt-16">
        <div class="container-x">
            <div class="flex flex-wrap items-center justify-center gap-2" role="tablist" aria-label="Filter kategori galeri">
                <a
                    href="{{ route('gallery') }}"
                    class="{{ is_null($activeCategory) ? 'bg-navy-900 text-white' : 'bg-white text-navy-800 hover:bg-navy-50' }} rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-navy-950/5 transition"
                    aria-current="{{ is_null($activeCategory) ? 'page' : 'false' }}"
                >
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a
                        href="{{ route('gallery', ['category' => $category]) }}"
                        class="{{ $activeCategory === $category ? 'bg-navy-900 text-white' : 'bg-white text-navy-800 hover:bg-navy-50' }} rounded-full px-5 py-2.5 text-sm font-semibold shadow-sm ring-1 ring-navy-950/5 transition"
                        aria-current="{{ $activeCategory === $category ? 'page' : 'false' }}"
                    >
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== GRID GALERI + LIGHTBOX ===== --}}
    <section
        x-data="{ openIndex: null }"
        x-init="$watch('openIndex', (value) => { document.body.style.overflow = value !== null ? 'hidden' : '' })"
        @keydown.escape.window="openIndex = null"
        class="py-12 lg:py-14"
    >
        <div class="container-x">
            @if ($galleries->isEmpty())
                <div class="mx-auto max-w-md rounded-3xl bg-white p-10 text-center shadow-card">
                    <p class="font-display text-lg font-bold text-navy-950">Belum Ada Foto</p>
                    <p class="mt-2 text-sm text-navy-700/80">
                        Foto untuk kategori ini belum tersedia. Silakan kembali lagi nanti.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 lg:grid-cols-3 lg:gap-5" data-reveal>
                    @foreach ($galleries as $index => $gallery)
                        <x-gallery-card
                            :gallery="$gallery"
                            @click="openIndex = {{ $index }}"
                        />
                    @endforeach
                </div>

                {{-- Lightbox --}}
                <div
                    x-cloak
                    x-show="openIndex !== null"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-[70] flex items-center justify-center bg-navy-950/90 p-4 backdrop-blur-sm"
                    role="dialog"
                    aria-modal="true"
                    aria-label="Tampilan foto galeri"
                    @click="openIndex = null"
                >
                    <template x-for="(photo, i) in {{ json_encode($galleries->pluck('image_url')->all()) }}" :key="i" hidden>
                        <figure
                            class="max-w-4xl"
                            x-show="openIndex === i"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                        >
                            <img
                                :src="photo"
                                :alt="`Foto ${i + 1} dari {{ $galleries->total() }}`"
                                class="max-h-[75vh] w-auto rounded-2xl shadow-2xl"
                                @click.stop
                            >
                            <figcaption class="mt-4 flex items-center justify-between text-sm text-navy-200" @click.stop>
                                <span x-text="`${i + 1} / {{ $galleries->total() }}`"></span>
                                <button
                                    type="button"
                                    @click="openIndex = (i + 1) % {{ $galleries->total() }}"
                                    class="btn-accent !px-5 !py-2"
                                >
                                    Berikutnya
                                </button>
                            </figcaption>
                        </figure>
                    </template>
                </div>

                <div class="mt-12">
                    {{ $galleries->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection