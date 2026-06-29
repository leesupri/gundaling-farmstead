import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { SplitText } from 'gsap/SplitText';

window.Alpine = Alpine;
window.gsap = gsap;
Alpine.plugin(intersect);
Alpine.start();

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, SplitText);

/** All scene reveals, parallax, stagger grids, timeline, and counters — registered once layout is stable. */
function initScrollAnimations() {
    // --- Hero background parallax ---
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg && document.querySelector('#hero')) {
        gsap.to(heroBg, {
            yPercent: 25,
            ease: 'none',
            scrollTrigger: {
                trigger: '#hero',
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            },
        });
    }

    // --- Scene reveals (image slides from left, text from right) ---
    document.querySelectorAll('.scene').forEach((scene) => {
        const img = scene.querySelector('.scene-img');
        const text = scene.querySelector('.scene-text');

        if (img) {
            gsap.from(img, {
                x: -60,
                opacity: 0,
                duration: 0.9,
                ease: 'power2.out',
                scrollTrigger: { trigger: scene, start: 'top 75%', toggleActions: 'play none none reverse' },
            });
        }

        if (text) {
            gsap.from(text, {
                x: 60,
                opacity: 0,
                duration: 0.9,
                delay: 0.15,
                ease: 'power2.out',
                scrollTrigger: { trigger: scene, start: 'top 70%', toggleActions: 'play none none reverse' },
            });
        }
    });

    // --- Stagger grid entrances ---
    const staggerGrid = (gridSelector, itemSelector, options = {}) => {
        document.querySelectorAll(gridSelector).forEach((grid) => {
            gsap.from(grid.querySelectorAll(itemSelector), {
                y: options.y ?? 30,
                opacity: 0,
                duration: options.duration ?? 0.6,
                stagger: options.stagger ?? 0.1,
                ease: 'power2.out',
                scrollTrigger: { trigger: grid, start: 'top 80%' },
            });
        });
    };

    staggerGrid('.cheese-grid', '.cheese-card', { y: 40, duration: 0.6, stagger: 0.12 });
    staggerGrid('.menu-grid', '.menu-item-card', { y: 20, duration: 0.5, stagger: 0.08 });
    staggerGrid('.promo-grid', '.promo-card', { y: 30, duration: 0.5, stagger: 0.1 });
    staggerGrid('.ambience-strip', '.photo', { y: 60, duration: 0.9, stagger: 0.15 });

    // --- Timeline progress line draw (About page) ---
    const timelineLine = document.querySelector('.timeline-connector');
    if (timelineLine) {
        gsap.fromTo(timelineLine, { scaleX: 0 }, {
            scaleX: 1,
            transformOrigin: 'left center',
            ease: 'none',
            scrollTrigger: { trigger: timelineLine, start: 'top 80%', end: 'bottom 50%', scrub: 1 },
        });
    }

    // --- Timeline milestone dots ---
    const timelineDots = document.querySelectorAll('.timeline-dot');
    if (timelineDots.length) {
        gsap.from(timelineDots, {
            scale: 0.5,
            opacity: 0,
            duration: 0.5,
            stagger: 0.3,
            ease: 'back.out(1.7)',
            scrollTrigger: { trigger: '.timeline', start: 'top 60%' },
        });
    }

    // --- Stat counters ---
    document.querySelectorAll('.stat-number').forEach((el) => {
        const target = parseInt(el.dataset.value ?? el.textContent, 10);
        if (Number.isNaN(target)) {
            return;
        }

        gsap.fromTo(el, { textContent: 0 }, {
            textContent: target,
            duration: 1.5,
            ease: 'power1.out',
            snap: { textContent: 1 },
            scrollTrigger: { trigger: el, start: 'top 85%' },
        });
    });
}

const mm = gsap.matchMedia();

mm.add('(prefers-reduced-motion: no-preference)', () => {
    // --- Mascot idle floats (scene mascots, not the gated hero mascot) ---
    document.querySelectorAll('.mascot-idle').forEach((el) => {
        gsap.to(el, { y: -10, duration: 1.8, ease: 'sine.inOut', yoyo: true, repeat: -1 });
    });

    // --- Footer walking mascot ---
    const walkMascot = document.querySelector('.walk-mascot');
    if (walkMascot) {
        gsap.to(walkMascot, { x: window.innerWidth + 80, duration: 14, ease: 'none', repeat: -1 });
        gsap.to(walkMascot, { y: -3, duration: 0.45, ease: 'sine.inOut', yoyo: true, repeat: -1 });
    }

    // --- WhatsApp float entrance ---
    const waFloat = document.querySelector('.wa-float');
    if (waFloat) {
        gsap.from(waFloat, { scale: 0, opacity: 0, duration: 0.5, ease: 'back.out(1.7)', delay: 1 });
    }

    // --- Menu/featured card image hover zoom (Emil pattern: scale inside overflow-hidden) ---
    document.querySelectorAll('.menu-item-card').forEach((card) => {
        const img = card.querySelector('img');
        if (!img) {
            return;
        }

        card.addEventListener('mouseenter', () => {
            gsap.to(img, { scale: 1.08, duration: 0.6, ease: 'power2.out' });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(img, { scale: 1, duration: 0.5, ease: 'power2.out' });
        });
    });

    // 2. WAIT FOR FONTS — SplitText needs correct letter/word widths.
    document.fonts.ready.then(() => {
        const heroTitle = document.querySelector('.hero-title');
        if (heroTitle) {
            const split = new SplitText(heroTitle, { type: 'words' });

            const tl = gsap.timeline({ delay: 0.2 });
            tl.from('.hero-eyebrow', { y: 24, opacity: 0, duration: 0.7, ease: 'power3.out' })
                .from(split.words, { y: 60, opacity: 0, duration: 0.8, stagger: 0.06, ease: 'power3.out' }, '-=0.4')
                .from('.hero-sub', { y: 20, opacity: 0, duration: 0.7, ease: 'power3.out' }, '-=0.5')
                .from('.hero-cta', { y: 16, opacity: 0, duration: 0.6, stagger: 0.1, ease: 'power3.out' }, '-=0.4');
        }

        // 3. WAIT FOR HERO IMAGE — fade skeleton, spring in the hero mascot, then idle float.
        const skeleton = document.getElementById('hero-skeleton');
        const heroImg = document.getElementById('hero-img');
        const heroMascot = document.querySelector('.mascot-hero');

        const heroReady = () => {
            if (skeleton) {
                gsap.to(skeleton, {
                    opacity: 0,
                    duration: 0.6,
                    ease: 'power2.out',
                    onComplete: () => skeleton.remove(),
                });
            }

            if (heroMascot) {
                gsap.to(heroMascot, {
                    opacity: 1,
                    x: 0,
                    scale: 1,
                    duration: 0.9,
                    ease: 'back.out(1.7)',
                    delay: 0.2,
                });
                gsap.to(heroMascot, {
                    y: -10,
                    repeat: -1,
                    yoyo: true,
                    duration: 3.6,
                    ease: 'sine.inOut',
                    delay: 1.2,
                });
            }
        };

        if (!heroImg || heroImg.complete) {
            heroReady();
        } else {
            heroImg.addEventListener('load', heroReady);
            heroImg.addEventListener('error', heroReady);
        }
    });

    // 4. ALL SCROLLTRIGGER — after window.load, once layout is stable.
    window.addEventListener('load', () => {
        ScrollTrigger.refresh();
        initScrollAnimations();
    });
});

// --- Directional hover fill for CTA buttons (runs regardless of reduced-motion) ---
document.querySelectorAll('.btn-farmstead').forEach((btn) => {
    const fill = btn.querySelector('.btn-fill');
    if (!fill) {
        return;
    }

    btn.addEventListener('mouseenter', (e) => {
        const rect = btn.getBoundingClientRect();
        const fromLeft = (e.clientX - rect.left) < rect.width / 2;
        gsap.fromTo(fill, { scaleX: 0, transformOrigin: fromLeft ? 'left' : 'right' }, { scaleX: 1, duration: 0.35, ease: 'power2.out' });
    });

    btn.addEventListener('mouseleave', (e) => {
        const rect = btn.getBoundingClientRect();
        const toLeft = (e.clientX - rect.left) < rect.width / 2;
        gsap.to(fill, { scaleX: 0, transformOrigin: toLeft ? 'left' : 'right', duration: 0.3, ease: 'power2.in' });
    });
});
