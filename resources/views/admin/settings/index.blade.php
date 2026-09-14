@extends('admin.layouts.app')

@section('title', 'Pengaturan Situs')

@section('heading', 'Pengaturan Situs')

@section('content')
    @php
        $hours = old('hours_day') ? array_map(fn ($i) => ['day' => old('hours_day')[$i] ?? '', 'time' => old('hours_time')[$i] ?? ''], array_keys(old('hours_day'))) : site_setting_array('hours');
    @endphp
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" x-data="{ hours: @js($hours) }">
        @csrf

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700" role="alert">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-6">
            <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Identitas Situs</h2>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1.5 block text-sm font-semibold text-navy-800">Nama Warung</label>
                            <input type="text" name="name" id="name" value="{{ old('name', site_setting('name')) }}" required maxlength="150"
                                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                        </div>
                        <div>
                            <label for="tagline" class="mb-1.5 block text-sm font-semibold text-navy-800">Tagline</label>
                            <input type="text" name="tagline" id="tagline" value="{{ old('tagline', site_setting('tagline')) }}" required maxlength="150"
                                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                        </div>
                    </div>
                    <div>
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-navy-800">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" maxlength="1000" required
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">{{ old('description', site_setting('description')) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="logo" class="mb-1.5 block text-sm font-semibold text-navy-800">Upload Logo (opsional)</label>
                            <input type="file" name="logo" id="logo" accept="image/*"
                                class="w-full text-sm text-navy-700 file:mr-3 file:rounded-xl file:border-0 file:bg-navy-950 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-white hover:file:bg-navy-800">
                            <p class="mt-1 text-xs text-navy-700">Saat ini: <code class="rounded bg-cream-100 px-1.5 py-0.5">{{ site_setting('logo') }}</code></p>
                        </div>
                        <div>
                            <label for="hero" class="mb-1.5 block text-sm font-semibold text-navy-800">Upload Foto Utama (opsional)</label>
                            <input type="file" name="hero" id="hero" accept="image/*"
                                class="w-full text-sm text-navy-700 file:mr-3 file:rounded-xl file:border-0 file:bg-navy-950 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-white hover:file:bg-navy-800">
                            <p class="mt-1 text-xs text-navy-700">Saat ini: <code class="rounded bg-cream-100 px-1.5 py-0.5">{{ site_setting('hero') }}</code></p>
                        </div>
                    </div>
                    <div>
                        <label for="about" class="mb-1.5 block text-sm font-semibold text-navy-800">Upload Foto Halaman Tentang (opsional)</label>
                        <input type="file" name="about" id="about" accept="image/*"
                            class="w-full text-sm text-navy-700 file:mr-3 file:rounded-xl file:border-0 file:bg-navy-950 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-white hover:file:bg-navy-800">
                        <p class="mt-1 text-xs text-navy-700">Saat ini: <code class="rounded bg-cream-100 px-1.5 py-0.5">{{ site_setting('about') }}</code></p>
                    </div>
                </div>
            </section>

            <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Kontak &amp; Media Sosial</h2>
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="whatsapp" class="mb-1.5 block text-sm font-semibold text-navy-800">Nomor WhatsApp (untuk link pesan)</label>
                        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', site_setting('whatsapp')) }}" maxlength="50" inputmode="tel"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                            placeholder="62xxx tanpa tanda +">
                    </div>
                    <div>
                        <label for="wa_display" class="mb-1.5 block text-sm font-semibold text-navy-800">Nomor WhatsApp (yang ditampilkan)</label>
                        <input type="text" name="wa_display" id="wa_display" value="{{ old('wa_display', site_setting('wa_display')) }}" maxlength="50" inputmode="tel"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                            placeholder="+62 xxx">
                    </div>
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-semibold text-navy-800">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', site_setting('email')) }}" maxlength="255"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="wa_message" class="mb-1.5 block text-sm font-semibold text-navy-800">Teks Pesan WhatsApp</label>
                        <input type="text" name="wa_message" id="wa_message" value="{{ old('wa_message', site_setting('wa_message')) }}" maxlength="500"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                    </div>
                    <div>
                        <label for="instagram" class="mb-1.5 block text-sm font-semibold text-navy-800">Instagram</label>
                        <input type="url" name="instagram" id="instagram" value="{{ old('instagram', site_setting('instagram')) }}" maxlength="255"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                            placeholder="https://instagram.com/...">
                    </div>
                    <div>
                        <label for="facebook" class="mb-1.5 block text-sm font-semibold text-navy-800">Facebook</label>
                        <input type="url" name="facebook" id="facebook" value="{{ old('facebook', site_setting('facebook')) }}" maxlength="255"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                            placeholder="https://facebook.com/...">
                    </div>
                    <div>
                        <label for="tiktok" class="mb-1.5 block text-sm font-semibold text-navy-800">TikTok</label>
                        <input type="url" name="tiktok" id="tiktok" value="{{ old('tiktok', site_setting('tiktok')) }}" maxlength="255"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                            placeholder="https://tiktok.com/@...">
                    </div>
                </div>
            </section>

            <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 font-display text-lg font-bold text-navy-950">Lokasi</h2>
                <div class="space-y-5">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label for="address" class="mb-1.5 block text-sm font-semibold text-navy-800">Alamat Lengkap</label>
                            <input type="text" name="address" id="address" value="{{ old('address', site_setting('address')) }}" required maxlength="255"
                                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                        </div>
                        <div>
                            <label for="city" class="mb-1.5 block text-sm font-semibold text-navy-800">Kota</label>
                            <input type="text" name="city" id="city" value="{{ old('city', site_setting('city')) }}" required maxlength="100"
                                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
                        </div>
                    </div>
                    <div>
                        <label for="maps_embed" class="mb-1.5 block text-sm font-semibold text-navy-800">Embed Google Maps (iframe src)</label>
                        <textarea name="maps_embed" id="maps_embed" rows="3" maxlength="2000"
                            class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">{{ old('maps_embed', site_setting('maps_embed')) }}</textarea>
                    </div>
                </div>
            </section>

            <section class="rounded-3xl border border-cream-200 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center justify-between">
                    <h2 class="font-display text-lg font-bold text-navy-950">Jam Operasional</h2>
                    <button type="button" @click="hours.push({ day: '', time: '' })" class="rounded-xl bg-navy-950 px-4 py-2 text-sm font-bold text-white transition hover:bg-navy-800">+ Tambah Baris</button>
                </div>
                <div class="space-y-3">
                    <template x-for="(row, index) in hours" :key="index">
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-[1fr_1fr_auto] sm:items-center">
                            <div>
                                <label class="mb-1 block text-xs font-semibold text-navy-700" x-text="'Hari ' + (index + 1)"></label>
                                <input type="text" x-model="row.day" :name="'hours_day[' + index + ']'" maxlength="100"
                                    class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                                    placeholder="Senin – Jumat">
                            </div>
                            <div>
                                <label class="mb-1 block text-xs font-semibold text-navy-700">Jam Buka</label>
                                <input type="text" x-model="row.time" :name="'hours_time[' + index + ']'" maxlength="100"
                                    class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30"
                                    placeholder="10.00 – 21.00 WIB">
                            </div>
                            <button type="button" @click="hours.splice(index, 1)" class="mt-5 rounded-xl border border-red-200 px-3 py-2.5 text-sm font-bold text-red-600 transition hover:bg-red-600 hover:text-white" aria-label="Hapus baris jam operasional">Hapus</button>
                        </div>
                    </template>
                    <p class="text-xs text-navy-700">Perubahan jam operasional langsung tampil di beranda, footer, dan halaman kontak.</p>
                </div>
            </section>

            <div class="flex justify-end">
                <button type="submit" class="btn-accent !px-10 !py-3.5">Simpan Pengaturan</button>
            </div>
        </div>
    </form>
@endsection