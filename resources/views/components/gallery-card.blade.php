@props(['gallery'])

<button
    type="button"
    {{ $attributes }}
    aria-label="Lihat foto: {{ $gallery->title }}"
    class="group relative block w-full overflow-hidden rounded-2xl text-left shadow-card"
>
    <img
        src="{{ asset($gallery->image) }}"
        alt="{{ $gallery->title }}"
        class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105"
        loading="lazy"
    >
    <span class="absolute inset-0 flex items-center justify-center bg-navy-950/0 opacity-0 transition duration-300 group-hover:bg-navy-950/50 group-hover:opacity-100" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h4.5m9 0h4.5v4.5m0 9v4.5h-4.5m-9 0h-4.5v-4.5"/>
        </svg>
    </span>
    <span class="absolute bottom-3 left-3 right-3 flex items-center justify-between rounded-xl bg-white/90 px-4 py-2.5 backdrop-blur transition group-hover:bg-white">
        <span>
            <span class="block text-sm font-bold text-navy-950">{{ $gallery->title }}</span>
            <span class="block text-xs font-semibold uppercase tracking-wide text-navy-600">{{ $gallery->category }}</span>
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-accent-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/>
        </svg>
    </span>
</button>