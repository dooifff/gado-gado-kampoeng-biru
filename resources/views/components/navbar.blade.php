@php
    $navLinks = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'Tentang Kami'],
        ['route' => 'menu', 'label' => 'Menu'],
        ['route' => 'gallery', 'label' => 'Galeri'],
        ['route' => 'contact', 'label' => 'Kontak'],
    ];
    $waUrl = wa_link();
@endphp

<header
    x-data="{ scrolled: false, open: false }"
    x-init="$watch('open', (value) => { document.body.style.overflow = value ? 'hidden' : '' })"
    @scroll.window.throttle.200ms="scrolled = window.scrollY > 12"
    @keydown.escape.window="open = false"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
    :class="scrolled ? 'bg-white/95 shadow-lg shadow-navy-950/5 backdrop-blur' : 'bg-transparent'"
>
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-20 lg:px-8" aria-label="Navigasi utama">
        <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ site_setting('name') }}, kembali ke beranda">
            <img
                src="{{ asset(site_setting('logo')) }}"
                alt="Logo {{ site_setting('name') }}"
                class="h-10 w-10 rounded-full border-2 border-white/20 object-cover shadow-sm"
            >
            <span class="font-display text-base font-bold tracking-tight sm:text-xl">
                <span :class="scrolled ? 'text-navy-950' : 'text-cream-50'">Gado Gado</span>
                <span :class="scrolled ? 'text-accent-600' : 'text-accent-400'" class="hidden sm:inline"> Kampoeng Biru</span>
            </span>
        </a>

        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($navLinks as $link)
                @php
                    $isActive = request()->routeIs($link['route']);
                    $solidClass = $isActive
                        ? 'bg-navy-100 text-navy-950'
                        : 'text-navy-800 hover:text-accent-600';
                    $floatingClass = $isActive
                        ? 'bg-white/15 text-white'
                        : 'text-navy-100 hover:text-white';
                @endphp
                <a
                    href="{{ route($link['route']) }}"
                    aria-current="{{ $isActive ? 'page' : 'false' }}"
                    class="rounded-full px-4 py-2 text-sm font-semibold transition-colors duration-200"
                    :class="scrolled ? '{{ $solidClass }}' : '{{ $floatingClass }}'"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach

            <a
                href="{{ $waUrl ?? route('contact') }}"
                {{ $waUrl ? 'target=_blank rel=noreferrer' : '' }}
                class="btn-accent ml-3 !px-5 !py-2.5"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.172.174.229.426.157.663l-.42 1.384a.9.9 0 0 0 1.09 1.09l1.384-.42c.237-.072.489-.015.663.157A8.27 8.27 0 0 0 12 20.25Z"/>
                </svg>
                Pesan Sekarang
            </a>
        </div>

        <button
            type="button"
            @click="open = true"
            class="inline-flex items-center rounded-full p-2 transition lg:hidden"
            :class="scrolled ? 'text-navy-950' : 'text-cream-50'"
            aria-label="Buka menu navigasi"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
        </button>
    </nav>

    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 bg-navy-950/60 backdrop-blur-sm lg:hidden"
        @click="open = false"
    >
        <aside
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute inset-y-0 right-0 flex w-[85%] max-w-sm flex-col bg-white shadow-2xl"
            @click.stop
            aria-label="Menu navigasi mobile"
            role="dialog"
            aria-modal="true"
        >
            <div class="flex items-center justify-between border-b border-cream-200 px-6 py-4">
                <span class="font-display text-lg font-bold text-navy-950">
                    Gado Gado <span class="text-accent-500">Kampoeng Biru</span>
                </span>
                <button
                    type="button"
                    @click="open = false"
                    class="rounded-full p-2 text-navy-700 transition hover:bg-navy-50"
                    aria-label="Tutup menu navigasi"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col gap-1 px-4 py-6" aria-label="Menu navigasi mobile">
                @foreach ($navLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        @click="open = false"
                        class="rounded-xl px-4 py-3 text-base font-semibold transition {{ request()->routeIs($link['route']) ? 'bg-navy-900 text-white' : 'text-navy-800 hover:bg-cream-100' }}"
                    >
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="mt-auto border-t border-cream-200 px-6 py-6">
                <a
                    href="{{ $waUrl ?? route('contact') }}"
                    {{ $waUrl ? 'target=_blank rel=noreferrer' : '' }}
                    class="btn-accent w-full"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.172.174.229.426.157.663l-.42 1.384a.9.9 0 0 0 1.09 1.09l1.384-.42c.237-.072.489-.015.663.157A8.27 8.27 0 0 0 12 20.25Z"/>
                    </svg>
                    Pesan Sekarang
                </a>
            </div>
        </aside>
    </div>
</header>