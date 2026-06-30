import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import { MotionPathPlugin } from 'gsap/MotionPathPlugin';
import { SplitText } from 'gsap/SplitText';

window.Alpine = Alpine;
window.gsap = gsap;
Alpine.plugin(intersect);
Alpine.start();

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, MotionPathPlugin, SplitText);

/** All scene reveals, parallax, stagger grids, timeline, and counters — registered once layout is stable. */
function initScrollAnimations() {
    // --- Hero background parallax (every page with a .hero-bg image, not just the homepage) ---
    document.querySelectorAll('.hero-bg').forEach((heroBg) => {
        const section = heroBg.closest('section');
        if (!section) {
            return;
        }

        gsap.to(heroBg, {
            yPercent: 25,
            ease: 'none',
            scrollTrigger: {
                trigger: section,
                start: 'top top',
                end: 'bottom top',
                scrub: true,
            },
        });
    });

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

    staggerGrid('.menu-grid', '.menu-item-card', { y: 20, duration: 0.5, stagger: 0.08 });
    staggerGrid('.promo-grid', '.promo-card', { y: 30, duration: 0.5, stagger: 0.1 });
    staggerGrid('.ambience-strip', '.photo', { y: 60, duration: 0.9, stagger: 0.15 });

    // --- Pinned sequential cheese-card reveal (Scene 3) ---
    const cheeseSection = document.querySelector('.cheese-pin-section');
    const cheeseCards = cheeseSection?.querySelectorAll('.cheese-card');
    if (cheeseSection && cheeseCards?.length) {
        gsap.set(cheeseCards, { opacity: 0, y: 40, scale: 0.92 });

        const cheeseTl = gsap.timeline({
            scrollTrigger: {
                trigger: cheeseSection,
                start: 'top top',
                end: '+=150%',
                pin: true,
                scrub: 1,
                anticipatePin: 1,
            },
        });

        cheeseCards.forEach((card, i) => {
            cheeseTl.to(card, { opacity: 1, y: 0, scale: 1, duration: 1, ease: 'power2.out' }, i);
        });
    }

    // --- Scroll progress bar (whole-page scrub) ---
    const progressBar = document.querySelector('.scroll-progress-bar');
    if (progressBar) {
        gsap.to(progressBar, {
            scaleX: 1,
            ease: 'none',
            scrollTrigger: { trigger: document.body, start: 'top top', end: 'bottom bottom', scrub: true },
        });
    }

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

/**
 * Mascot rides a viewport-relative S-curve as the user scrolls the whole page (hero → footer).
 * Path is defined in viewport percentages (not document pixels) so it stays correct at any
 * viewport size or content height, and is rebuilt on resize.
 */
function initMascotPathFollow() {
    const track = document.querySelector('.mascot-path-track');
    if (!track) {
        return;
    }

    const buildPath = () => {
        const w = window.innerWidth;
        const h = window.innerHeight;
        const points = [
            { x: w * 0.85, y: h * 0.15 },
            { x: w * 0.15, y: h * 0.35 },
            { x: w * 0.82, y: h * 0.55 },
            { x: w * 0.18, y: h * 0.75 },
            { x: w * 0.5, y: h * 0.88 },
        ];

        let d = `M${points[0].x},${points[0].y}`;
        for (let i = 1; i < points.length; i++) {
            const prev = points[i - 1];
            const curr = points[i];
            const midY = (prev.y + curr.y) / 2;
            d += ` C${prev.x},${midY} ${curr.x},${midY} ${curr.x},${curr.y}`;
        }
        return d;
    };

    let timeline;

    const setup = () => {
        if (timeline) {
            timeline.scrollTrigger?.kill();
            timeline.kill();
        }

        timeline = gsap.timeline({
            scrollTrigger: {
                trigger: document.body,
                start: 'top top',
                end: 'bottom bottom',
                scrub: true,
            },
        })
            .to(track, { opacity: 1, duration: 0.05 }, 0)
            .to(track, { motionPath: { path: buildPath(), autoRotate: false }, ease: 'none', duration: 1 }, 0)
            .to(track, { opacity: 0, duration: 0.08 }, 0.9);
    };

    setup();

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            setup();
            ScrollTrigger.refresh();
        }, 200);
    });
}

/** Side-rail dots tracking which of the 5 homepage story steps is in view; click to jump to one. */
function initSceneRail() {
    const dots = document.querySelectorAll('.scene-rail-dot');
    const steps = document.querySelectorAll('[data-step]');
    if (!dots.length || !steps.length) {
        return;
    }

    const setActiveDot = (activeDot) => {
        dots.forEach((dot) => {
            const isActive = dot === activeDot;
            gsap.to(dot, {
                scale: isActive ? 1.6 : 1,
                backgroundColor: isActive ? '#F5C542' : 'rgba(130, 190, 137, 0.5)',
                duration: 0.3,
                ease: 'power2.out',
            });
        });
    };

    steps.forEach((stepEl) => {
        const dot = document.querySelector(`.scene-rail-dot[data-step-target="${stepEl.dataset.step}"]`);
        if (!dot) {
            return;
        }

        ScrollTrigger.create({
            trigger: stepEl,
            start: 'top center',
            end: 'bottom center',
            onEnter: () => setActiveDot(dot),
            onEnterBack: () => setActiveDot(dot),
        });
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const target = document.querySelector(`[data-step="${dot.dataset.stepTarget}"]`);
            if (target) {
                gsap.to(window, { duration: 0.9, ease: 'power2.inOut', scrollTo: { y: target, offsetY: 0 } });
            }
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

        // Secondary page heroes (About, Contact, Promo, Reservations): simple fade-up entrance.
        document.querySelectorAll('.hero-content-fade').forEach((el) => {
            gsap.from(el, { y: 24, opacity: 0, duration: 0.8, ease: 'power3.out', delay: 0.2 });
        });

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
        initMascotPathFollow();
        initSceneRail();
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
