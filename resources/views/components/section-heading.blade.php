@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'align' => 'center',
    'light' => false,
])

<div class="max-w-2xl {{ $align === 'left' ? '' : 'mx-auto text-center' }}">
    @if ($eyebrow)
        <p class="{{ $light ? 'eyebrow-light' : 'eyebrow' }}">{{ $eyebrow }}</p>
    @endif

    @if ($title)
        <h2 class="section-title {{ $light ? 'text-cream-50' : 'text-navy-950' }}">
            {{ $title }}
        </h2>
    @endif

    @if ($description)
        <p class="mt-4 text-base leading-relaxed sm:text-lg {{ $light ? 'text-navy-200' : 'text-navy-700/80' }}">
            {{ $description }}
        </p>
    @endif
</div>