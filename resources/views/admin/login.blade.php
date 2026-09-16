<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin — {{ site_setting('name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ site_setting_image('logo') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-navy-950 px-4 py-12">
    <div class="w-full max-w-md">
        <a href="{{ route('home') }}" class="mb-8 flex flex-col items-center gap-3 text-center" aria-label="{{ site_setting('name') }}, kembali ke beranda">
            <img src="{{ site_setting_image('logo') }}" alt="Logo {{ site_setting('name') }}" class="h-20 w-20 rounded-full border-2 border-white/20 object-cover shadow-lg">
            <div>
                <p class="font-display text-xl font-bold text-white">{{ site_setting('name') }}</p>
                <p class="mt-1 text-sm font-semibold tracking-wide text-accent-400 uppercase">Panel Admin</p>
            </div>
        </a>

        <form method="POST" action="{{ route('admin.login.submit') }}" class="rounded-3xl bg-white p-8 shadow-2xl">
            @csrf

            <h2 class="mb-6 text-center font-display text-2xl font-bold text-navy-950">Silakan Masuk</h2>

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700" role="alert">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-5">
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-navy-800">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="admin@example.test">
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-semibold text-navy-800">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="••••••••">
                </div>

                <label class="flex items-center gap-2 text-sm font-medium text-navy-700">
                    <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-cream-300 text-accent-500 focus:ring-accent-500">
                    Ingat saya
                </label>

                <button type="submit" class="btn-accent w-full !py-3">
                    Masuk
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-navy-300">
            Hanya pemilik dan admin yang dapat mengakses panel ini.
        </p>
    </div>
</body>
</html>