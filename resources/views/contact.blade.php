@php
    $waNumber = preg_replace('/\D+/u', '', (string) site_setting('whatsapp'));
    $waBase = $waNumber !== '' ? 'https://wa.me/' . $waNumber : null;
    $instagram = site_social_url('instagram');
    $facebook = site_social_url('facebook');
    $tiktok = site_social_url('tiktok');
    $email = str_starts_with((string) site_setting('email'), '[') ? null : site_setting('email');
@endphp

@extends('layouts.app', [
    'title' => 'Kontak — ' . site_setting('name'),
    'meta_description' => 'Hubungi Gado Gado Kampoeng Biru: alamat, jam operasional, WhatsApp, Instagram, dan peta lokasi. Pesan langsung atau mampir ke warung kami.',
])

@section('content')

    {{-- ===== PAGE HERO ===== --}}
    <section class="relative overflow-hidden bg-navy-950 pt-28 pb-16 lg:pt-36 lg:pb-20">
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 30% 20%, rgba(232,150,51,0.7) 0 2px, transparent 2.5px); background-size: 30px 30px;" aria-hidden="true"></div>
        <div class="container-x relative text-center">
            <p class="eyebrow-light">Kontak Kami</p>
            <h1 class="font-display mt-4 text-4xl font-bold tracking-tight text-cream-50 sm:text-5xl">
                Mari Terhubung &amp; <span class="text-accent-400">Mampir</span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-navy-200 sm:text-lg">
                Ada pertanyaan, ingin memesan, atau sekadar menyapa? Kami siap membantu dengan
                senang hati.
            </p>
        </div>
    </section>

    {{-- ===== INFO CONTACT ===== --}}
    <section class="pt-14 lg:pt-16">
        <div class="container-x grid gap-6 sm:grid-cols-2 lg:grid-cols-4" data-reveal>
            @php
                $infoCards = [
                    [!!$waBase, true, 'WhatsApp', wa_display(), $waBase, 'fill', 'M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm5.83 14.12c-.25.7-1.45 1.33-2 1.38-.53.05-1.02.24-3.44-.72-2.9-1.14-4.75-4.11-4.9-4.3-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.29.57-.36.76-.36h.55c.18 0 .42-.07.65.5.24.59.8 2.04.88 2.19.07.14.12.31.02.5-.1.19-.15.31-.3.48-.14.17-.3.38-.43.5-.14.15-.29.31-.13.6.17.29.75 1.23 1.6 2 .9.81 1.66 1.07 1.9 1.19.24.12.38.1.52-.06.14-.17.6-.7.76-.94.16-.24.32-.2.54-.12.22.07 1.4.66 1.63.78.24.12.4.18.46.28.06.1.06.57-.19 1.24Z'],
                    [!!$instagram, true, 'Instagram', '@' . str_replace(['https://www.instagram.com/', 'https://instagram.com/', '@'], '', $instagram ?? ''), $instagram, 'none', 'M6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5ZM16.5 7.5h.008v.008H16.5V7.5Z'],
                    [!!$email, false, 'Email', $email, 'mailto:' . $email, 'none', 'M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0v1.5a2.25 2.25 0 0 0 4.5 0V12a9 9 0 1 0-9 9'],
                    [true, false, 'Alamat', site_setting('address') . ', ' . site_setting('city'), '#', 'none', 'M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM20 12a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z'],
                ];
            @endphp
            @foreach ($infoCards as [ $available, $external, $label, $value, $href, $stroke, $icon ])
                @if ($available)
                    <a
                        href="{{ $href }}"
                        {{ $external ? 'target=_blank rel=noreferrer' : '' }}
                        class="card group p-7 transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                    >
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-navy-900 text-accent-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="{{ $stroke === 'fill' ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" {{ $stroke === 'none' ? 'stroke-width=1.8 stroke=currentColor' : '' }} aria-hidden="true">
                                <path {{ $stroke === 'none' ? 'stroke-linecap=round stroke-linejoin=round' : '' }} d="{{ $icon }}"/>
                            </svg>
                        </span>
                        <p class="mt-4 text-xs font-bold uppercase tracking-wide text-accent-600">{{ $label }}</p>
                        <p class="mt-1 break-words text-sm font-semibold text-navy-950">{{ $value }}</p>
                    </a>
                @endif
            @endforeach
        </div>
    </section>

    {{-- ===== FORM PESAN + PETA ===== --}}
    <section class="py-14 lg:py-20">
        <div class="container-x grid gap-10 lg:grid-cols-2 lg:gap-14" data-reveal>
            <div>
                <p class="eyebrow">Pesan Langsung</p>
                <h2 class="section-title">Tulis Pesanan atau Pertanyaanmu</h2>
                <p class="mt-4 leading-relaxed text-navy-700/80">
                    Isi nama dan pesanmu, lalu kirim — pesan akan langsung terbuka di WhatsApp kami
                    sehingga kamu bisa melanjutkan percakapan.
                </p>

                @if ($waBase)
                    <form
                        class="mt-8 space-y-5"
                        @submit.prevent="window.open(url, '_blank')"
                        x-data="{
                            nama: '',
                            pesan: '{{ e(site_setting('wa_message')) }}',
                            get url() {
                                const text = [this.pesan, this.nama ? 'Nama: ' + this.nama : ''].filter(Boolean).join('\n\n');
                                return {{ '"' . $waBase . '"' }} + '?text=' + encodeURIComponent(text);
                            }
                        }"
                    >
                        <div>
                            <label for="contact-name" class="text-sm font-bold text-navy-950">Nama Kamu</label>
                            <input
                                id="contact-name"
                                type="text"
                                x-model="nama"
                                placeholder="Contoh: Budi Santoso"
                                class="form-input"
                            >
                        </div>
                        <div>
                            <label for="contact-pesan" class="text-sm font-bold text-navy-950">Pesan / Pemesanan</label>
                            <textarea
                                id="contact-pesan"
                                x-model="pesan"
                                rows="5"
                                placeholder="Tulis pesan atau daftar pesananmu di sini..."
                                class="form-input resize-none"
                            ></textarea>
                        </div>
                        <button type="submit" class="btn-accent w-full sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Z"/>
                            </svg>
                            Kirim via WhatsApp
                        </button>
                    </form>
                @else
                    <div class="mt-8 rounded-2xl bg-white p-6 text-sm leading-relaxed text-navy-700/80 shadow-card">
                        Nomor WhatsApp belum tersedia. Silakan hubungi kami melalui kontak lain atau
                        mampir langsung ke warung. Formulir pesan akan aktif setelah nomor
                        WhatsApp customer ditambahkan di pengaturan situs.
                    </div>
                @endif
            </div>

            <div class="flex flex-col gap-8">
                <x-map-embed />

                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="card p-7">
                        <p class="flex items-center gap-2 text-xs font-bold uppercase tracking-wide text-accent-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            Jam Operasional
                        </p>
                        <ul class="mt-4 space-y-3 text-sm">
                            @foreach (site_setting_array('hours') as $hours)
                                <li class="flex items-center justify-between gap-4">
                                    <span class="font-semibold text-navy-900">{{ $hours['day'] }}</span>
                                    <span class="text-navy-700/80">{{ $hours['time'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card p-7">
                        <p class="text-xs font-bold uppercase tracking-wide text-accent-600">Ikuti Kami</p>
                        <p class="mt-2 text-sm leading-relaxed text-navy-700/80">
                            Simak kabar terbaru, menu spesial, dan momen kami di media sosial.
                        </p>
                        <div class="mt-4 flex gap-3">
                            @if ($waBase)
                                <a href="{{ $waBase }}" target="_blank" rel="noreferrer" aria-label="WhatsApp {{ site_setting('name') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-navy-900 text-accent-400 transition hover:bg-accent-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($instagram)
                                <a href="{{ $instagram }}" target="_blank" rel="noreferrer" aria-label="Instagram {{ site_setting('name') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-navy-900 text-accent-400 transition hover:bg-accent-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5ZM16.5 7.5h.008v.008H16.5V7.5Z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($facebook)
                                <a href="{{ $facebook }}" target="_blank" rel="noreferrer" aria-label="Facebook {{ site_setting('name') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-navy-900 text-accent-400 transition hover:bg-accent-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v2.25H17l-.75 3h-2v6h-3v-6H9.5v-3h1.75V8.75a3 3 0 0 1 3-3H16v2.25h-1.5a.75.75 0 0 0-.75.75Z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($tiktok)
                                <a href="{{ $tiktok }}" target="_blank" rel="noreferrer" aria-label="TikTok {{ site_setting('name') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-navy-900 text-accent-400 transition hover:bg-accent-500 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.5c.3 2.25 1.8 3.75 4.5 4v3c-1.8 0-3.4-.6-4.5-1.5v5.25c0 3-2.25 5.25-5.25 5.25S5.5 18.75 5.5 15.75s2.25-5.25 5.25-5.25c.3 0 .6 0 .9.07V12.6a3.07 3.07 0 0 0-.9-.22c-2.7-.3-4.5 1.9-4.5 4.3 0 2.4 1.8 4 4.5 4s4.25-1.7 4.25-4.5v-12Z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection