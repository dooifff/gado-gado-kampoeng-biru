@extends('layouts.app', [
    'title' => site_setting('name') . ' — ' . site_setting('tagline'),
    'meta_description' => site_setting('description'),
])

@section('content')

    @push('scripts')
        @php
            $hasCustomerData = ! \Illuminate\Support\Str::startsWith((string) site_setting('address'), '[')
                && ! \Illuminate\Support\Str::startsWith((string) site_setting('whatsapp'), '[');
        @endphp
        @if ($hasCustomerData)
            <script type="application/ld+json">
                @php
                    $structuredData = [
                        '@context' => 'https://schema.org',
                        '@type' => 'Restaurant',
                        'name' => site_setting('name'),
                        'image' => site_setting_image('hero'),
                        'description' => site_setting('description'),
                        'servesCuisine' => 'Masakan Nusantara',
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => site_setting('address'),
                            'addressLocality' => site_setting('city'),
                            'addressCountry' => 'ID',
                        ],
                    ];
                @endphp
                {!! \Illuminate\Support\Js::from($structuredData) !!}
            </script>
        @endif
    @endpush

    {{-- ===== HERO ===== --}}
    <section data-hero class="relative overflow-hidden bg-navy-950 pt-28 pb-20 lg:pt-36 lg:pb-28">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 15% 20%, rgba(232,150,51,0.6) 0 2px, transparent 2.5px), radial-gradient(circle at 75% 70%, rgba(232,150,51,0.5) 0 2px, transparent 2.5px); background-size: 34px 34px;" aria-hidden="true"></div>
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-accent-500/10 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-cream-50/5 blur-3xl" aria-hidden="true"></div>

        <div class="container-x relative grid items-center gap-14 lg:grid-cols-2 lg:gap-8">
            <div>
                <p class="eyebrow-light hero-item hero-d-1">Kuliner Khas Nusantara</p>
                <h1 class="font-display hero-item hero-d-2 mt-4 text-4xl font-bold leading-[1.1] tracking-tight text-cream-50 sm:text-5xl lg:text-6xl">
                    Rasa Khas <span class="text-accent-400">Kampoeng</span>, Selalu Bikin Kangen
                </h1>
                <p class="hero-item hero-d-3 mt-6 max-w-xl text-base leading-relaxed text-navy-200 sm:text-lg">
                    {{ site_setting('description') }}
                </p>

                <div class="hero-item hero-d-4 mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('menu') }}" class="btn-accent">
                        Lihat Menu
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('gallery') }}" class="btn-outline-light">Lihat Suasana</a>
                </div>

                <ul class="hero-item hero-d-5 mt-10 grid max-w-md grid-cols-3 gap-6 border-t border-white/10 pt-8">
                    <li>
                        <p class="font-display text-2xl font-bold text-accent-400">10+</p>
                        <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-navy-300">Menu Pilihan</p>
                    </li>
                    <li>
                        <p class="font-display text-2xl font-bold text-accent-400">5.0</p>
                        <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-navy-300">Rating Pelanggan</p>
                    </li>
                    <li>
                        <p class="font-display text-2xl font-bold text-accent-400">100%</p>
                        <p class="mt-1 text-xs font-semibold uppercase tracking-wide text-navy-300">Cita Rasa Autentik</p>
                    </li>
                </ul>
            </div>

            <div class="hero-item hero-d-3 relative flex justify-center lg:justify-end">
                <div class="relative w-full max-w-md lg:max-w-none">
                    <img
                        src="{{ site_setting_image('hero') }}"
                        alt="Ilustrasi menu andalan {{ site_setting('name') }}"
                        class="w-full drop-shadow-2xl"
                        width="640"
                        height="640"
                    >
                    <div class="card absolute -left-4 bottom-6 hidden items-center gap-3 px-5 py-4 sm:flex lg:left-0">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-accent-500 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2.25l2.91 5.72 6.36.9-4.64 4.53 1.11 6.32L12 16.83l-5.74 2.89 1.11-6.32-4.64-4.53 6.36-.9L12 2.25z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-bold text-navy-950">Disukai Pelanggan</p>
                            <p class="text-xs text-navy-600">Gado-Gado &amp; Es Cendol Biru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ABOUT PREVIEW ===== --}}
    <section class="py-20 lg:py-28">
        <div class="container-x grid items-center gap-12 lg:grid-cols-2 lg:gap-16" data-reveal>
            <div>
                <img
                    src="{{ site_setting_image('about') }}"
                    alt="Suasana {{ site_setting('name') }}"
                    class="w-full rounded-3xl shadow-card ring-1 ring-navy-950/5"
                    loading="lazy"
                >
            </div>

            <div>
                <p class="eyebrow">Tentang Kami</p>
                <h2 class="section-title">Warung Kecil, Citarasa Kampoeng yang Jujur</h2>
                <p class="mt-5 leading-relaxed text-navy-700/80">
                    {{ site_setting('name') }} hadir untuk membawa cita rasa masakan kampoeng yang sederhana,
                    hangat, dan sepenuh hati. Setiap piring disiapkan dari bahan segar setiap hari,
                    diracik dengan rempah pilihan, dan disajikan dengan keramahan seorang tuan rumah.
                </p>

                <ul class="mt-7 space-y-4">
                    @php
                        $aboutPoints = [
                            'Bahan segar dipilih setiap pagi langsung dari pasar tradisional',
                            'Resep autentik yang diwariskan turun-temurun',
                            'Porsi jujur dengan harga yang bersahabat',
                            'Tempat nyaman untuk makan bersama keluarga dan teman',
                        ];
                    @endphp
                    @foreach ($aboutPoints as $point)
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-accent-100 text-accent-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke-width="3" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </span>
                            <span class="text-sm leading-relaxed text-navy-800">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('about') }}" class="btn-navy mt-8">
                    Cerita Lengkap Kami
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== MENU FAVORIT ===== --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x" data-reveal>
            <x-section-heading
                eyebrow="Menu Andalan"
                title="Favorit yang Wajib Dicoba"
                description="Pilihan menu yang paling banyak dipesan dan selalu membuat pelanggan kembali lagi."
            />

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featuredMenus as $menu)
                    <x-menu-card :menu="$menu" />
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('menu') }}" class="btn-navy">
                    Lihat Menu Lengkap
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== WHY CHOOSE US ===== --}}
    <section class="bg-cream-100/60 py-20 lg:py-28">
        <div class="container-x" data-reveal>
            <x-section-heading
                eyebrow="Kenapa Kami?"
                title="Alasan Pelanggan Kembali Lagi"
            />

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $reasons = [
                        ['icon' => 'M3.75 13.5 12 5.25l8.25 8.25m4.5 0v7.5a1.5 1.5 0 0 1-1.5 1.5H14.25v-4.5H9.75v4.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-7.5m4.5 0A.75.75 0 0 1 9 12.75h6a.75.75 0 0 1 .75.75v4.5', 'title' => 'Bahan Selalu Segar', 'text' => 'Sayur dan bumbu dibeli segar setiap pagi, dimasak dalam porsi harian tanpa penyimpanan lama.'],
                        ['icon' => 'M12 3v2.25m6.36.39-1.59 1.59m3.234 3.27h-2.25M9.75 21c0-3.9 1.975-5.25 2.25-5.25.276 0 2.25 1.35 2.25 5.25h-4.5Z  M12 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5Z', 'title' => 'Rasa Autentik', 'text' => 'Resep turun-temurun diracik dengan rempah pilihan, mempertahankan cita rasa kampoeng sesungguhnya.'],
                        ['icon' => 'M12 6v12m-3-2.25h5.25a2.25 2.25 0 0 0 0-4.5h-4.5a2.25 2.25 0 0 1 0-4.5H15M12 6v1.5M12 16.5v1.5', 'title' => 'Harga Bersahabat', 'text' => 'Porsi jujur dan mengenyangkan dengan harga yang ramah di kantong semua kalangan.'],
                        ['icon' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0', 'title' => 'Layanan Ramah', 'text' => 'Disambut hangat layaknya keluarga, dari senyuman sampai saran menu terbaik untukmu.'],
                    ];
                @endphp
                @foreach ($reasons as $reason)
                    <div class="card p-7 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $reason['icon'] }}"/>
                            </svg>
                        </span>
                        <h3 class="mt-5 font-display text-lg font-bold text-navy-950">{{ $reason['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-navy-700/80">{{ $reason['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== GALLERY PREVIEW ===== --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x" data-reveal>
            <x-section-heading
                eyebrow="Galeri"
                title="Suasana &amp; Momen Kami"
                description="Sekilas tentang makanan, tempat, dan momen hangat bersama pelanggan di warung kami."
            />

            <div class="mt-12 grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-5">
                @foreach ($galleryPreview as $index => $gallery)
                    <a href="{{ route('gallery') }}" class="group relative block overflow-hidden rounded-2xl" aria-label="Lihat foto: {{ $gallery->title }}">
                        <img
                            src="{{ $gallery->image_url }}"
                            alt="{{ $gallery->title }}"
                            class="{{ $index === 0 ? 'aspect-square' : 'aspect-[4/3]' }} w-full object-cover transition duration-500 group-hover:scale-105"
                            loading="lazy"
                        >
                        <span class="absolute inset-0 bg-gradient-to-t from-navy-950/70 via-transparent to-transparent opacity-0 transition duration-300 group-hover:opacity-100"></span>
                        <span class="absolute bottom-3 left-3 right-3 translate-y-2 text-left opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                            <span class="block text-sm font-bold text-white">{{ $gallery->title }}</span>
                            <span class="block text-xs font-semibold uppercase tracking-wide text-accent-300">{{ $gallery->category }}</span>
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('gallery') }}" class="btn-navy">
                    Jelajahi Galeri
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== TESTIMONIALS ===== --}}
    <section class="relative overflow-hidden bg-navy-950 py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 85% 15%, rgba(232,150,51,0.7) 0 2px, transparent 2.5px), radial-gradient(circle at 15% 85%, rgba(232,150,51,0.6) 0 2px, transparent 2.5px); background-size: 30px 30px;" aria-hidden="true"></div>

        <div class="container-x relative" data-reveal>
            <x-section-heading
                eyebrow="Testimoni"
                title="Kata Mereka yang Mampir"
                light
            />

            <div
                x-data="{ i: 0, total: {{ count($testimonials) }} }"
                @keydown.arrow-left.window="i = (i - 1 + total) % total"
                @keydown.arrow-right.window="i = (i + 1) % total"
                class="relative mx-auto mt-14 max-w-3xl"
                role="region"
                aria-label="Testimoni pelanggan"
            >
                <div class="overflow-hidden">
                    <div
                        class="flex transition-transform duration-500 ease-out"
                        :style="`transform: translateX(-${i * 100}%)`"
                    >
                        @foreach ($testimonials as $t)
                            <div class="w-full shrink-0 px-2 sm:px-4">
                                <x-testimonial-card :testimonial="$t" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <button
                    type="button"
                    @click="i = (i - 1 + total) % total"
                    class="absolute -left-2 top-1/2 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white text-navy-900 shadow-lg transition hover:bg-accent-500 hover:text-white sm:flex lg:-left-14"
                    aria-label="Testimoni sebelumnya"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                </button>
                <button
                    type="button"
                    @click="i = (i + 1) % total"
                    class="absolute -right-2 top-1/2 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full bg-white text-navy-900 shadow-lg transition hover:bg-accent-500 hover:text-white sm:flex lg:-right-14"
                    aria-label="Testimoni berikutnya"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </button>

                <div class="mt-8 flex justify-center gap-2">
                    @foreach ($testimonials as $index => $t)
                        <button
                            type="button"
                            @click="i = {{ $index }}"
                            class="h-2.5 rounded-full transition-all duration-300"
                            :class="i === {{ $index }} ? 'w-8 bg-accent-500' : 'w-2.5 bg-white/25 hover:bg-white/50'"
                            :aria-label="`Lihat testimoni ke-{{ $index + 1 }}`"
                        ></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===== LOKASI & JAM OPERASIONAL ===== --}}
    <section class="py-20 lg:py-28">
        <div class="container-x grid items-center gap-10 lg:grid-cols-2 lg:gap-14" data-reveal>
            <x-map-embed />

            <div>
                <p class="eyebrow">Lokasi &amp; Jam Buka</p>
                <h2 class="section-title">Mampir, Kami Siap Menyambutmu</h2>
                <p class="mt-5 leading-relaxed text-navy-700/80">
                    Temukan kami di {{ site_setting('city') }}. Ajak keluarga dan teman untuk menikmati
                    hidangan khas kampoeng yang hangat dan menyehatkan.
                </p>

                <ul class="mt-8 space-y-5">
                    <li class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.14-7.5 11.25-7.5 11.25S4.5 17.64 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="font-display text-base font-bold text-navy-950">Alamat</p>
                            <p class="mt-1 text-sm leading-relaxed text-navy-700/80">
                                {{ site_setting('address') }}, {{ site_setting('city') }}
                            </p>
                        </div>
                    </li>

                    <li class="flex items-start gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="font-display text-base font-bold text-navy-950">Jam Operasional</p>
                            <ul class="mt-1 space-y-1.5 text-sm text-navy-700/80">
                                @foreach (site_setting_array('hours') as $hours)
                                    <li>
                                        <span class="font-semibold text-navy-900">{{ $hours['day'] }}</span> — {{ $hours['time'] }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="pb-20 lg:pb-28">
        <div class="container-x">
            <div class="relative overflow-hidden rounded-3xl bg-navy-950 px-6 py-14 text-center sm:px-14 lg:py-16" data-reveal>
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, rgba(232,150,51,0.8) 0 2px, transparent 2.5px); background-size: 26px 26px;" aria-hidden="true"></div>
                <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-accent-500/20 blur-3xl" aria-hidden="true"></div>
                <div class="absolute -bottom-20 -left-20 h-72 w-72 rounded-full bg-cream-50/10 blur-3xl" aria-hidden="true"></div>

                <div class="relative">
                    <h2 class="font-display text-3xl font-bold tracking-tight text-cream-50 sm:text-4xl">
                        Sudah Lapar? Yuk, Pesan Sekarang
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-base leading-relaxed text-navy-200">
                        Pesan langsung melalui WhatsApp dan rasakan kehangatan masakan khas kampoeng
                        yang selalu bikin kangen.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a
                            href="{{ wa_link() ?? route('contact') }}"
                            {{ wa_link() ? 'target=_blank rel=noreferrer' : '' }}
                            class="btn-accent"
                            aria-label="Pesan menu {{ site_setting('name') }} melalui WhatsApp"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Z"/>
                            </svg>
                            Pesan via WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="btn-outline-light">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection