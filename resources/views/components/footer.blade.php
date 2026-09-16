@php
    $waUrl = wa_link();
    $instagram = site_social_url('instagram');
    $facebook = site_social_url('facebook');
    $tiktok = site_social_url('tiktok');
    $navLinks = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'Tentang Kami'],
        ['route' => 'menu', 'label' => 'Menu'],
        ['route' => 'gallery', 'label' => 'Galeri'],
        ['route' => 'contact', 'label' => 'Kontak'],
    ];
@endphp

<footer class="bg-navy-950 text-navy-200">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:grid-cols-2 sm:px-6 lg:grid-cols-4 lg:px-8">
        <div>
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ site_setting('name') }}, beranda">
                <img
                    src="{{ site_setting_image('logo') }}"
                    alt="Logo {{ site_setting('name') }}"
                    class="h-11 w-11 rounded-full object-cover"
                >
                <span class="font-display text-lg font-bold text-cream-50">
                    Gado Gado <span class="text-accent-400">Kampoeng Biru</span>
                </span>
            </a>
            <p class="mt-4 text-sm leading-relaxed text-navy-300">
                {{ site_setting('description') }}
            </p>
            <div class="mt-5 flex gap-3">
                @if ($waUrl)
                    <a href="{{ $waUrl }}" target="_blank" rel="noreferrer" aria-label="WhatsApp {{ site_setting('name') }}"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-cream-50 transition hover:bg-accent-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Zm5.83 14.12c-.25.7-1.45 1.33-2 1.38-.53.05-1.02.24-3.44-.72-2.9-1.14-4.75-4.11-4.9-4.3-.14-.19-1.17-1.56-1.17-2.97 0-1.42.74-2.11 1-2.4.26-.29.57-.36.76-.36h.55c.18 0 .42-.07.65.5.24.59.8 2.04.88 2.19.07.14.12.31.02.5-.1.19-.15.31-.3.48-.14.17-.3.38-.43.5-.14.15-.29.31-.13.6.17.29.75 1.23 1.6 2 .9.81 1.66 1.07 1.9 1.19.24.12.38.1.52-.06.14-.17.6-.7.76-.94.16-.24.32-.2.54-.12.22.07 1.4.66 1.63.78.24.12.4.18.46.28.06.1.06.57-.19 1.24Z"/>
                        </svg>
                    </a>
                @endif
                @if ($instagram)
                    <a href="{{ $instagram }}" target="_blank" rel="noreferrer" aria-label="Instagram {{ site_setting('name') }}"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-cream-50 transition hover:bg-accent-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 7.5h.008v.008H16.5V7.5Z"/>
                        </svg>
                    </a>
                @endif
                @if ($facebook)
                    <a href="{{ $facebook }}" target="_blank" rel="noreferrer" aria-label="Facebook {{ site_setting('name') }}"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-cream-50 transition hover:bg-accent-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9v2.25H17l-.75 3h-2v6h-3v-6H9.5v-3h1.75V8.75a3 3 0 0 1 3-3H16v2.25h-1.5a.75.75 0 0 0-.75.75Z"/>
                        </svg>
                    </a>
                @endif
                @if ($tiktok)
                    <a href="{{ $tiktok }}" target="_blank" rel="noreferrer" aria-label="TikTok {{ site_setting('name') }}"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-cream-50 transition hover:bg-accent-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 4.5c.3 2.25 1.8 3.75 4.5 4v3c-1.8 0-3.4-.6-4.5-1.5v5.25c0 3-2.25 5.25-5.25 5.25S5.5 18.75 5.5 15.75s2.25-5.25 5.25-5.25c.3 0 .6 0 .9.07V12.6a3.07 3.07 0 0 0-.9-.22c-2.7-.3-4.5 1.9-4.5 4.3 0 2.4 1.8 4 4.5 4s4.25-1.7 4.25-4.5v-12Z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>

        <div>
            <p class="font-display text-base font-bold text-cream-50">Navigasi</p>
            <ul class="mt-4 space-y-3 text-sm">
                @foreach ($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="inline-block transition hover:text-accent-400">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <p class="font-display text-base font-bold text-cream-50">Kontak</p>
            <ul class="mt-4 space-y-3 text-sm">
                <li class="flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.14-7.5 11.25-7.5 11.25S4.5 17.64 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                    <span>
                        {{ site_setting('address') }}
                        <br>({{ site_setting('city') }})
                    </span>
                </li>
                <li class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-accent-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38a9.9 9.9 0 0 0 4.74 1.21h.01c5.46 0 9.9-4.45 9.9-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2Z"/>
                    </svg>
                    {{ wa_display() }}
                </li>
                <li class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0v1.5a2.25 2.25 0 0 0 4.5 0V12a9 9 0 1 0-9 9"/>
                    </svg>
                    {{ site_setting('email') }}
                </li>
            </ul>
        </div>

        <div>
            <p class="font-display text-base font-bold text-cream-50">Jam Operasional</p>
            <ul class="mt-4 space-y-3 text-sm">
                @foreach (site_setting_array('hours') as $hours)
                    <li class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 shrink-0 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span>
                            <span class="block font-semibold text-cream-50">{{ $hours['day'] }}</span>
                            {{ $hours['time'] }}
                        </span>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('contact') }}" class="btn-accent mt-6 !px-5 !py-2.5">
                Hubungi Kami
            </a>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-6 text-center text-xs text-navy-400 sm:flex-row sm:px-6 lg:px-8">
            <p>&copy; {{ date('Y') }} {{ site_setting('name') }}. Seluruh hak cipta dilindungi.</p>
            <p class="mt-0.5 text-navy-500">{{ site_setting('tagline') }}</p>
            <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1 transition hover:text-accent-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Login / Daftar
                    </a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-1 transition hover:text-accent-400">
                            Keluar ({{ Str::limit(auth()->user()->name, 20) }})
                        </button>
                    </form>
                @endguest
                <span aria-hidden="true" class="text-navy-600">•</span>
                <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1 transition hover:text-accent-400">Masuk Admin</a>
            </div>
        </div>
    </div>
</footer>