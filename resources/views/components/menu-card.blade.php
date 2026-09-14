@props(['menu'])

<article class="card group overflow-hidden transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-navy-950/10">
    <div class="relative overflow-hidden">
        <img
            src="{{ asset($menu->image) }}"
            alt="{{ $menu->name }}"
            class="aspect-[4/3] w-full object-cover transition duration-500 group-hover:scale-105"
            loading="lazy"
        >
        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-3 py-1 text-xs font-bold uppercase tracking-wide text-navy-800 backdrop-blur">
            {{ $menu->category }}
        </span>
    </div>

    <div class="flex items-start justify-between gap-3 p-6">
        <div>
            <h3 class="font-display text-lg font-bold text-navy-950">{{ $menu->name }}</h3>
            <p class="mt-2 text-sm leading-relaxed text-navy-700/80">{{ $menu->description }}</p>
        </div>
        <p class="shrink-0 font-display text-lg font-bold text-accent-600">{{ $menu->rupiah }}</p>
    </div>
</article>