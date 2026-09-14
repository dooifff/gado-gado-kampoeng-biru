@extends('admin.layouts.app')

@section('title', 'Menu')

@section('heading', 'Menu')

@section('actions')
    <a href="{{ route('admin.menus.create') }}" class="btn-accent !px-5 !py-2.5">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Menu
    </a>
@endsection

@section('content')
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <form method="GET" action="{{ route('admin.menus.index') }}" class="flex w-full max-w-sm gap-2">
            <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari nama atau kategori..."
                class="w-full rounded-xl border border-cream-300 bg-white px-4 py-2.5 text-sm text-navy-950 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30">
            <button type="submit" class="rounded-xl bg-navy-950 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-navy-800">Cari</button>
        </form>
        <p class="text-sm font-semibold text-navy-700">{{ $menus->total() }} item</p>
    </div>

    <div class="overflow-hidden rounded-3xl border border-cream-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-cream-200 text-sm">
                <thead class="bg-cream-50">
                    <tr class="text-left text-xs font-bold tracking-wide text-navy-700 uppercase">
                        <th class="px-5 py-4">Menu</th>
                        <th class="px-5 py-4">Kategori</th>
                        <th class="px-5 py-4">Harga</th>
                        <th class="px-5 py-4 text-center">Andalan</th>
                        <th class="px-5 py-4 text-center">Aktif</th>
                        <th class="px-5 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-100">
                    @forelse ($menus as $menu)
                        <tr class="transition hover:bg-cream-50/60">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="h-11 w-11 shrink-0 rounded-xl border border-cream-200 object-cover">
                                    <div class="min-w-0">
                                        <p class="truncate font-bold text-navy-950">{{ $menu->name }}</p>
                                        <p class="truncate text-xs text-navy-700">{{ Str::limit($menu->description, 40) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3">
                                <span class="rounded-full bg-navy-950 px-3 py-1 text-xs font-semibold text-white">{{ $menu->category }}</span>
                            </td>
                            <td class="px-5 py-3 font-semibold text-navy-950">{{ $menu->rupiah }}</td>
                            <td class="px-5 py-3 text-center">
                                <span class="text-lg {{ $menu->is_featured ? 'text-amber-500' : 'text-cream-300' }}" aria-label="{{ $menu->is_featured ? 'Menjadi andalan' : 'Bukan andalan' }}">★</span>
                            </td>
                            <td class="px-5 py-3 text-center">
                                @if ($menu->is_active)
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">Aktif</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.menus.edit', $menu) }}" class="rounded-lg bg-cream-100 px-3 py-2 text-xs font-bold text-navy-800 transition hover:bg-navy-950 hover:text-white" aria-label="Edit {{ $menu->name }}">Edit</a>
                                    <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" onsubmit="return confirm('Hapus menu {{ $menu->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg bg-red-100 px-3 py-2 text-xs font-bold text-red-700 transition hover:bg-red-600 hover:text-white" aria-label="Hapus {{ $menu->name }}">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-sm text-navy-700">
                                Belum ada menu. <a href="{{ route('admin.menus.create') }}" class="font-bold text-accent-600 underline">Tambahkan sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($menus->hasPages())
            <div class="border-t border-cream-200 px-5 py-4">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection