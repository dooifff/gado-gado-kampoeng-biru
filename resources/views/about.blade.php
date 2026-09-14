@extends('layouts.app', [
    'title' => 'Tentang Kami — ' . site_setting('name'),
    'meta_description' => 'Kenali cerita, sejarah, visi, dan misi Gado Gado Kampoeng Biru. Warung kecil dengan cita rasa kampoeng yang jujur dan hangat.',
])

@section('content')

    {{-- ===== PAGE HERO ===== --}}
    <section class="relative overflow-hidden bg-navy-950 pt-28 pb-16 lg:pt-36 lg:pb-20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 80% 20%, rgba(232,150,51,0.7) 0 2px, transparent 2.5px); background-size: 30px 30px;" aria-hidden="true"></div>
        <div class="container-x relative text-center">
            <p class="eyebrow-light">Tentang Kami</p>
            <h1 class="font-display mt-4 text-4xl font-bold tracking-tight text-cream-50 sm:text-5xl">
                Cerita di Balik Rasa <span class="text-accent-400">Kampoeng Biru</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-navy-200 sm:text-lg">
                Lebih dari sekadar warung makan — sebuah ruang hangat untuk berkumpul,
                berbagi cerita, dan menikmati masakan khas Nusantara.
            </p>
        </div>
    </section>

    {{-- ===== SEJARAH CERITA ===== --}}
    <section class="py-20 lg:py-28">
        <div class="container-x grid items-center gap-12 lg:grid-cols-2 lg:gap-16" data-reveal>
            <div>
                <img
                    src="{{ asset(site_setting('about')) }}"
                    alt="Suasana dan cerita {{ site_setting('name') }}"
                    class="w-full rounded-3xl shadow-card ring-1 ring-navy-950/5"
                >
            </div>
            <div>
                <p class="eyebrow">Cerita Kami</p>
                <h2 class="section-title">Dari Dapur Rumah, Untuk Semua</h2>
                <div class="mt-5 space-y-4 leading-relaxed text-navy-700/80">
                    <p>
                        Semuanya bermula dari dapur kecil keluarga yang selalu ramai setiap jam makan.
                        Aroma bumbu gado-gado yang diracik langsung, suara rebusan kuah santan,
                        dan senyum para tetangga yang singgah — dari sanalah cita rasa
                        {{ site_setting('name') }} lahir.
                    </p>
                    <p>
                        Kami percaya masakan terbaik adalah masakan yang dimasak dengan hati.
                        Karena itu setiap hari, tanpa henti, kami menghadirkan resep turun-temurun
                        dengan bahan segar yang dipilih sendiri di pasar pagi.
                    </p>
                    <p>
                        Kini warung kecil kami menjadi tempat berkumpul favorit banyak orang —
                        dari pekerja yang mampir setelah jam kantor, keluarga yang pulang kampung,
                        hingga generasi muda yang ingin merasakan kehangatan masakan rumahan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== HIS TORY TIMELINE ===== --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x">
            <x-section-heading
                eyebrow="Perjalanan Kami"
                title="Perjalanan Menjadi Kampoeng Biru"
            />

            <ol class="relative mx-auto mt-14 max-w-3xl space-y-12 border-l border-navy-100 pl-8 sm:pl-10" data-reveal>
                @php
                    $milestones = [
                        ['year' => 'Awal Mula', 'title' => 'Dapur Rumah Keluarga', 'text' => 'Cita rasa diracik pertama kali di dapur rumah, hanya untuk keluarga dan tetangga terdekat.'],
                        ['year' => 'Melangkah', 'title' => 'Warung Kecil Berdiri', 'text' => 'Warung sederhana dibuka dengan menu utama gado-gado dan es cendol — yang kini menjadi ikon Kampoeng Biru.'],
                        ['year' => 'Tumbuh', 'title' => 'Dicintai Pelanggan', 'text' => 'Semakin banyak pelanggan setia datang setiap hari. Menu dikembangkan dengan masakan khas Nusantara lainnya.'],
                        ['year' => 'Dalam Perjalanan', 'title' => 'Terus Melayani Sebaik Mungkin', 'text' => 'Menjaga kualitas, kehangatan, dan cita rasa kampoeng dalam setiap piring yang kami sajikan.'],
                    ];
                @endphp
                @foreach ($milestones as $milestone)
                    <li class="relative">
                        <span class="absolute -left-[41px] top-1 flex h-9 w-9 items-center justify-center rounded-full bg-accent-500 text-white ring-4 ring-white sm:-left-[49px]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M12 2.25l2.91 5.72 6.36.9-4.64 4.53 1.11 6.32L12 16.83l-5.74 2.89 1.11-6.32-4.64-4.53 6.36-.9L12 2.25z"/>
                            </svg>
                        </span>
                        <p class="eyebrow">{{ $milestone['year'] }}</p>
                        <h3 class="font-display mt-2 text-xl font-bold text-navy-950">{{ $milestone['title'] }}</h3>
                        <p class="mt-2 max-w-xl text-sm leading-relaxed text-navy-700/80">{{ $milestone['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ===== VISI & MISI ===== --}}
    <section class="py-20 lg:py-28">
        <div class="container-x">
            <x-section-heading
                eyebrow="Visi &amp; Misi"
                title="Arah dan Tujuan Kami"
            />

            <div class="mx-auto mt-14 grid max-w-4xl gap-6 lg:grid-cols-2" data-reveal>
                <div class="card bg-navy-950 p-8 ring-navy-950">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 text-accent-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </span>
                    <h3 class="font-display mt-5 text-xl font-bold text-cream-50">Visi</h3>
                    <p class="mt-3 text-sm leading-relaxed text-navy-200">
                        Menjadi warung kuliner khas Nusantara yang paling dicintai, dikenal karena
                        cita rasa autentik, bahan berkualitas, dan keramahan yang membuat setiap
                        pelanggan merasa seperti di rumah sendiri.
                    </p>
                </div>

                <div class="card p-8">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </span>
                    <h3 class="font-display mt-5 text-xl font-bold text-navy-950">Misi</h3>
                    <ul class="mt-3 space-y-2.5 text-sm leading-relaxed text-navy-700/80">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                            Menyajikan makanan dari bahan segar yang dipilih setiap hari.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                            Melestarikan resep dan cita rasa masakan khas Nusantara.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                            Melayani dengan keramahan dan kehangatan keluarga.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-accent-500"></span>
                            Menjaga kebersihan dan kualitas di setiap proses.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== NILAI KAMI ===== --}}
    <section class="bg-white py-20 lg:py-28">
        <div class="container-x">
            <x-section-heading
                eyebrow="Nilai Kami"
                title="Prinsip yang Kami Pegang"
            />

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal>
                @php
                    $values = [
                        ['title' => 'Kualitas Terbaik', 'text' => 'Bahan segar dan proses bersih tanpa kompromi.', 'icon' => 'M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'],
                        ['title' => 'Kejujuran', 'text' => 'Porsi jujur dan harga yang transparan untuk semua.', 'icon' => 'M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636'],
                        ['title' => 'Kehangatan', 'text' => 'Setiap pelanggan disambut seperti keluarga sendiri.', 'icon' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z'],
                        ['title' => 'Kearifan Lokal', 'text' => 'Menjaga warisan rasa khas kampoeng Nusantara.', 'icon' => 'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z'],
                    ];
                @endphp
                @foreach ($values as $value)
                    <div class="card p-7 text-center transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $value['icon'] }}"/>
                            </svg>
                        </span>
                        <h3 class="mt-5 font-display text-lg font-bold text-navy-950">{{ $value['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-navy-700/80">{{ $value['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FOTO KAMI ===== --}}
    <section class="py-20 lg:py-28">
        <div class="container-x">
            <x-section-heading
                eyebrow="Album Kami"
                title="Momen di Setiap Piring &amp; Meja"
            />

            <div class="mt-12 grid grid-cols-2 gap-4 lg:grid-cols-4 lg:gap-5" data-reveal>
                @foreach ($galleryPhotos as $gallery)
                    <a href="{{ route('gallery') }}" class="group relative block overflow-hidden rounded-2xl" aria-label="Lihat foto: {{ $gallery->title }}">
                        <img
                            src="{{ asset($gallery->image) }}"
                            alt="{{ $gallery->title }}"
                            class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105"
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
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="pb-20 lg:pb-28">
        <div class="container-x">
            <div class="relative overflow-hidden rounded-3xl bg-navy-950 px-6 py-14 text-center sm:px-14 lg:py-16" data-reveal>
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, rgba(232,150,51,0.8) 0 2px, transparent 2.5px); background-size: 26px 26px;" aria-hidden="true"></div>
                <div class="relative">
                    <h2 class="font-display text-3xl font-bold tracking-tight text-cream-50 sm:text-4xl">
                        Ingin Mencicipi Langsung?
                    </h2>
                    <p class="mx-auto mt-4 max-w-xl text-base leading-relaxed text-navy-200">
                        Kunjungi warung kami atau hubungi kami melalui WhatsApp untuk bertanya
                        tentang menu dan pemesanan.
                    </p>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('menu') }}" class="btn-accent">Lihat Menu</a>
                        <a href="{{ route('contact') }}" class="btn-outline-light">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection