import Alpine from 'alpinejs';

import './bootstrap';

window.Alpine = Alpine;
Alpine.start();

// Reveal on scroll (ringan, tanpa dependency).
(function revealOnScroll() {
    if (!('IntersectionObserver' in window)) {
        return;
    }

    // Tandai bahwa JS berjalan; hanya dalam kondisi ini elemen disembunyikan.
    document.documentElement.classList.add('js--reveal');

    const els = document.querySelectorAll('[data-reveal]');

    if (els.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
        );

        els.forEach((el) => observer.observe(el));
    }

    // Hero entrance: case konten hero muncul berurutan setelah frame pertama.
    const hero = document.querySelector('[data-hero]');
    if (hero) {
        requestAnimationFrame(() => hero.classList.add('is-loaded'));
    }
})();