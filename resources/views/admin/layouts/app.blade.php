@php
    $user = auth()->user();
    $navItems = [
        ['name' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75'],
        ['name' => 'Menu', 'route' => 'admin.menus.index', 'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 006 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 006-2.292c.938-.332 1.948-.512 3-.512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25'],
        ['name' => 'Galeri', 'route' => 'admin.galleries.index', 'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-5.159 5.159h15.75A2.25 2.25 0 0121.75 16.5V5.25a2.25 2.25 0 00-2.25-2.25H4.5a2.25 2.25 0 00-2.25 2.25v11.25a2.25 2.25 0 002.25 2.25h12.75zM15 6h3v3h-3V6z'],
        ['name' => 'Testimoni', 'route' => 'admin.testimonials.index', 'icon' => 'M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z'],
    ];
    if ($user->isOwner()) {
        $navItems[] = ['name' => 'Pengaturan', 'route' => 'admin.settings.index', 'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281zM15 12a3 3 0 11-6 0 3 3 0 016 0z'];
    }
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ site_setting('name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset(site_setting('logo')) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-cream-50 text-navy-950 antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen lg:flex">
        <button
            type="button"
            @click="sidebarOpen = true"
            class="fixed top-4 left-4 z-40 inline-flex items-center gap-2 rounded-full bg-navy-950 px-4 py-2 text-sm font-semibold text-white shadow-lg lg:hidden"
            aria-label="Buka menu admin"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
            Menu
        </button>

        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-navy-950/50 lg:hidden"
        ></div>

        <aside
            x-cloak
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-navy-950 text-white shadow-2xl transition-transform duration-300 lg:static lg:translate-x-0 lg:transition-none"
            aria-label="Menu admin"
        >
            <div class="flex items-center justify-between gap-3 border-b border-white/10 px-6 py-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset(site_setting('logo')) }}" alt="Logo {{ site_setting('name') }}" class="h-10 w-10 rounded-full border border-white/20 object-cover">
                    <span class="font-display text-sm font-bold leading-tight">
                        Admin<br><span class="text-accent-400">Kampoeng Biru</span>
                    </span>
                </a>
                <button type="button" @click="sidebarOpen = false" class="rounded-full p-1 text-white/70 hover:bg-white/10 lg:hidden" aria-label="Tutup menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="mt-2 flex-1 space-y-1 overflow-y-auto px-3 py-4">
                @foreach ($navItems as $item)
                    @php $active = request()->routeIs($item['route']); @endphp
                    <a
                        href="{{ route($item['route']) }}"
                        @click="sidebarOpen = false"
                        class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ $active ? 'bg-accent-500 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}"
                        aria-current="{{ $active ? 'page' : 'false' }}"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>

            <div class="space-y-3 border-t border-white/10 px-6 py-5">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm font-semibold text-white/70 transition hover:text-white" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                    </svg>
                    Lihat Situs
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center gap-2 rounded-xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="min-w-0 flex-1">
            <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                <header class="mb-8 mt-14 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between lg:mt-0">
                    <div>
                        <p class="text-sm font-semibold text-accent-600">{{ $user->isOwner() ? 'Pemilik' : 'Admin' }} — {{ $user->name }}</p>
                        <h1 class="font-display text-2xl font-bold text-navy-950 sm:text-3xl">@yield('heading')</h1>
                    </div>
                    <div class="shrink-0 sm:text-right">
                        @yield('actions')
                    </div>
                </header>

                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-cloak x-transition.opacity
                         class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-800" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>