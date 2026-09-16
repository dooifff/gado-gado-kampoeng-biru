@props(['testimonial'])

<figure class="card flex h-full flex-col p-7 transition duration-300 hover:-translate-y-1 hover:shadow-lg">
    <div class="flex items-center justify-between">
        <div class="flex gap-1" role="img" aria-label="Rating {{ $testimonial->rating }} dari 5">
            @for ($i = 1; $i <= 5; $i++)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'fill-accent-500 text-accent-500' : 'fill-transparent text-navy-200' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2.25l2.91 5.72 6.36.9-4.64 4.53 1.11 6.32L12 16.83l-5.74 2.89 1.11-6.32-4.64-4.53 6.36-.9L12 2.25z"/>
                </svg>
            @endfor
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-accent-500/30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M5.25 3.75h5.25v3.75A5.25 5.25 0 0 1 5.25 12.75zm8.25 0h5.25v3.75a5.25 5.25 0 0 1-5.25 5.25z"/>
        </svg>
    </div>

    <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-navy-800">
        &ldquo;{{ $testimonial->message }}&rdquo;
    </blockquote>

    <figcaption class="mt-6 flex items-center gap-3 border-t border-cream-200 pt-5">
        @if ($testimonial->image)
            <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" onerror="this.onerror=null;this.style.display='none'" class="h-11 w-11 rounded-full object-cover">
        @else
            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-navy-900 font-display text-base font-bold text-accent-400">
                {{ strtoupper(mb_substr($testimonial->name, 0, 1)) }}
            </span>
        @endif
        <div>
            <p class="text-sm font-bold text-navy-950">{{ $testimonial->name }}</p>
            <p class="text-xs text-navy-600">Pelanggan Setia</p>
        </div>
    </figcaption>
</figure>