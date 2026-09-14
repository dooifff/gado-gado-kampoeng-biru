@extends('admin.layouts.app')

@section('title', 'Testimoni')

@section('heading', 'Testimoni')

@section('actions')
    <a href="{{ route('admin.testimonials.create') }}" class="btn-accent !px-5 !py-2.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Testimoni
    </a>
@endsection

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex w-full max-w-sm gap-2">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama atau isi testimoni..."
                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
            <button type="submit" class="rounded-xl bg-navy-950 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-navy-800">Cari</button>
        </form>
        <p class="text-sm font-semibold text-navy-700">{{ $testimonials->total() }} testimoni</p>
    </div>

    <div class="overflow-hidden rounded-3xl border border-cream-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-cream-200 text-sm">
                <thead class="bg-cream-50">
                    <tr class="text-left text-xs font-bold tracking-wide text-navy-700 uppercase">
                        <th class="px-5 py-4">Pengunjung</th>
                        <th class="px-5 py-4">Rating</th>
                        <th class="px-5 py-4">Isi Testimoni</th>
                        <th class="px-5 py-4 text-center">Tampil di Situs</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-100">
                    @forelse ($testimonials as $testimonial)
                        <tr class="transition hover:bg-cream-50/60">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($testimonial->image)
                                        <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->name }}" class="h-11 w-11 shrink-0 rounded-full border border-cream-200 object-cover">
                                    @else
                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy-950 text-sm font-bold text-white">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <p class="font-bold text-navy-950">{{ $testimonial->name }}</p>
                                </div>
                            </td>
                            <td class="px-5 py-3 font-semibold text-amber-500">
                                {{ str_repeat('★', $testimonial->rating) }}<span class="text-cream-300">{{ str_repeat('★', 5 - $testimonial->rating) }}</span>
                            </td>
                            <td class="max-w-xs px-5 py-3">
                                <p class="line-clamp-2 text-navy-700">{{ $testimonial->message }}</p>
                            </td>
                            <td class="px-5 py-3 text-center">
                                @if ($testimonial->is_active)
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Aktif</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="rounded-lg bg-cream-100 px-3 py-2 text-xs font-bold text-navy-800 transition hover:bg-navy-950 hover:text-white">Edit</a>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" onsubmit="return confirm('Hapus testimoni dari {{ $testimonial->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-red-100 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-600 hover:text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-sm text-navy-700">
                                Belum ada testimoni. <a href="{{ route('admin.testimonials.create') }}" class="font-bold text-accent-600 underline">Tambahkan sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($testimonials->hasPages())
            <div class="border-t border-cream-200 px-5 py-4">{{ $testimonials->links() }}</div>
        @endif
    </div>
@endsection