@php
    $mapSrc = site_map_src();
@endphp

@if ($mapSrc)
    <div class="h-full overflow-hidden rounded-3xl shadow-card ring-1 ring-navy-950/5">
        <iframe
            title="Peta Google Maps lokasi {{ site_setting('name') }}"
            src="{{ $mapSrc }}"
            class="h-full min-h-[320px] w-full lg:min-h-[420px]"
            style="border: 0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
@else
    <div class="flex h-full min-h-[320px] flex-col items-center justify-center rounded-3xl bg-white p-10 text-center shadow-card ring-1 ring-navy-950/5 lg:min-h-[420px]">
        <span class="flex h-16 w-16 items-center justify-center rounded-full bg-navy-50 text-navy-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z"/>
            </svg>
        </span>
        <h3 class="mt-4 font-display text-lg font-bold text-navy-950">Peta Segera Hadir</h3>
        <p class="mt-2 max-w-sm text-sm leading-relaxed text-navy-700/80">
            Link Google Maps akan ditampilkan di sini setelah data lokasi dari customer sudah tersedia.
        </p>
    </div>
@endif