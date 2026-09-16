<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — {{ site_setting('name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ site_setting_image('logo') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-cream-100 px-4 py-12">
    <div class="w-full max-w-md">
        <a href="{{ route('home') }}" class="mb-8 flex flex-col items-center gap-3 text-center" aria-label="{{ site_setting('name') }}, kembali ke beranda">
            <img src="{{ site_setting_image('logo') }}" alt="Logo {{ site_setting('name') }}" class="h-20 w-20 rounded-full border-4 border-white object-cover shadow-soft">
            <div>
                <p class="font-display text-xl font-bold text-navy-950">{{ site_setting('name') }}</p>
                <p class="mt-1 text-sm font-semibold tracking-wide text-accent-600 uppercase">Daftar Pelanggan</p>
            </div>
        </a>

        <form method="POST" action="{{ route('register.submit') }}" class="rounded-3xl border border-cream-200 bg-white p-8 shadow-soft">
            @csrf

            <h2 class="mb-6 text-center font-display text-2xl font-bold text-navy-950">Buat Akun Baru</h2>

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
                    <label for="name" class="mb-1.5 block text-sm font-semibold text-navy-800">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name" maxlength="120"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="Nama Anda">
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-navy-800">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-semibold text-navy-800">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password" minlength="8"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-navy-800">Ulangi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                        class="w-full rounded-xl border border-cream-300 bg-cream-50 px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                        placeholder="Ulangi password">
                </div>

                <button type="submit" class="btn-accent w-full !py-3">
                    Daftar
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-navy-700">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-accent-600 underline hover:text-accent-700">Masuk di sini</a>
        </p>
    </div>
</body>
</html>