import { gsap } from 'gsap';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(SplitText);

/**
 * MENU HERO — 3D COVERFLOW CAROUSEL
 * Cards arranged in a 3D arc: active card front-center, side cards recede
 * in Z with Y-rotation, dim and blur; far cards hidden. Auto-rotates,
 * pauses on hover, supports dots/arrows/keyboard/swipe.
 */

const CAROUSEL_CONFIG = {
    autoPlayDelay: 4500,
    transitionDur: 0.65,

    // 3D position map per slot offset from center (index 0 = active)
    slots: [
        { tx: 0,    tz: 150,  ry: 0,   scale: 1.0,  opacity: 1.0,  blur: 0 }, // active
        { tx: 380,  tz: -40,  ry: -28, scale: 0.82, opacity: 0.75, blur: 1 }, // right-1
        { tx: 620,  tz: -140, ry: -42, scale: 0.66, opacity: 0.45, blur: 3 }, // right-2
        { tx: 760,  tz: -220, ry: -52, scale: 0.52, opacity: 0.0,  blur: 6 }, // right-3 (hidden)
        { tx: -380, tz: -40,  ry: 28,  scale: 0.82, opacity: 0.75, blur: 1 }, // left-1
        { tx: -620, tz: -140, ry: 42,  scale: 0.66, opacity: 0.45, blur: 3 }, // left-2
        { tx: -760, tz: -220, ry: 52,  scale: 0.52, opacity: 0.0,  blur: 6 }, // left-3 (hidden)
    ],

    ease: 'power3.out',
    easeSpring: 'back.out(1.4)',
};

let activeIndex = 0;
let totalSlides = 0;
let autoPlayTimer = null;
let isAnimating = false;
let isHovering = false;

// Which visual slot (0=center, 1=right-1, 4=left-1, …) a card occupies for a given center.
function getSlotIndex(cardIdx, centerIndex, total) {
    let offset = cardIdx - centerIndex;
    if (offset > total / 2) {
        offset -= total;
    }
    if (offset < -total / 2) {
        offset += total;
    }

    const map = { 0: 0, 1: 1, 2: 2, 3: 3, '-1': 4, '-2': 5, '-3': 6 };
    return map[offset] ?? 3; // anything further: hidden slot
}

function setCardPositions(cards, centerIndex, animate) {
    const cfg = CAROUSEL_CONFIG;

    cards.forEach((card, cardIdx) => {
        const slot = cfg.slots[getSlotIndex(cardIdx, centerIndex, cards.length)];
        const isActive = cardIdx === centerIndex;
        const glow = card.querySelector('.card-glow');

        gsap.to(card, {
            x: slot.tx,
            z: slot.tz,
            rotationY: slot.ry,
            scale: slot.scale,
            opacity: slot.opacity,
            filter: `blur(${slot.blur}px)`,
            zIndex: Math.round(slot.opacity * 10),
            duration: animate ? cfg.transitionDur : 0,
            ease: animate ? (isActive ? cfg.easeSpring : cfg.ease) : 'none',
            overwrite: 'auto',
        });

        if (glow) {
            gsap.to(glow, {
                opacity: isActive ? 0.35 : 0,
                duration: animate ? 0.5 : 0,
                ease: 'power2.out',
                overwrite: 'auto',
            });
        }
    });
}

function goToSlide(newIndex, cards, dots, slideLabel) {
    if (isAnimating || newIndex === activeIndex) {
        return;
    }
    isAnimating = true;

    stopAutoPlay();
    activeIndex = newIndex;

    cards.forEach((c, i) => {
        c.setAttribute('aria-selected', i === newIndex ? 'true' : 'false');
        c.setAttribute('tabindex', i === newIndex ? '0' : '-1');
    });

    dots.forEach((d, i) => {
        d.classList.toggle('active', i === newIndex);
    });

    setCardPositions(cards, newIndex, true);

    // Label swap: slide old up and out, new in from below, tinted to the dish palette.
    const activeCard = cards[newIndex];
    const newLabel = activeCard.dataset.label;
    const newColor = activeCard.dataset.color;

    gsap.to(slideLabel, {
        y: -20,
        opacity: 0,
        duration: 0.2,
        ease: 'power2.in',
        onComplete: () => {
            slideLabel.textContent = newLabel;
            slideLabel.style.borderColor = newColor + '55';
            slideLabel.style.background = newColor + '18';
            gsap.fromTo(slideLabel, { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.35, ease: 'power2.out' });
        },
    });

    gsap.delayedCall(CAROUSEL_CONFIG.transitionDur + 0.1, () => {
        isAnimating = false;
        if (!isHovering) {
            startAutoPlay(cards, dots, slideLabel);
        }
    });
}

function startAutoPlay(cards, dots, slideLabel) {
    stopAutoPlay();
    autoPlayTimer = setInterval(() => {
        goToSlide((activeIndex + 1) % totalSlides, cards, dots, slideLabel);
    }, CAROUSEL_CONFIG.autoPlayDelay);
}

function stopAutoPlay() {
    if (autoPlayTimer) {
        clearInterval(autoPlayTimer);
        autoPlayTimer = null;
    }
}

function initMenuCarousel() {
    const cards = document.querySelectorAll('.carousel-card');
    const dots = document.querySelectorAll('.carousel-dot');
    const stage = document.getElementById('carouselStage');
    const prevBtn = document.getElementById('carouselPrev');
    const nextBtn = document.getElementById('carouselNext');
    const slideLabel = document.getElementById('slideLabel');
    const hero = document.getElementById('menu-hero');

    if (!cards.length || !slideLabel) {
        return;
    }

    totalSlides = cards.length;

    const mm = gsap.matchMedia();

    mm.add('(prefers-reduced-motion: no-preference)', () => {
        // Slot positions first (instant), then entrance animates opacity/y only —
        // never the transforms the slots own, so the two can't fight.
        setCardPositions(cards, 0, false);

        gsap.from(cards, {
            y: 60,
            autoAlpha: 0,
            duration: 0.9,
            stagger: 0.06,
            delay: 0.5,
            ease: 'back.out(1.2)',
            clearProps: 'visibility',
        });

        gsap.fromTo('.menu-hero-eyebrow', { y: 20, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out', delay: 0.2 });

        const split = new SplitText('.menu-hero-title', { type: 'words' });
        gsap.set('.menu-hero-title', { opacity: 1 });
        gsap.from(split.words, { y: 60, opacity: 0, duration: 0.75, stagger: 0.07, ease: 'power3.out', delay: 0.35 });

        gsap.fromTo('.menu-hero-sub', { y: 24, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: 'power2.out', delay: 0.65 });

        gsap.fromTo(
            ['.menu-slide-label-wrap', '.carousel-dots'],
            { y: 16, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out', delay: 0.8, stagger: 0.1 },
        );

        startAutoPlay(cards, dots, slideLabel);

        return () => stopAutoPlay();
    });

    // Reduced motion: everything visible, active card only, no autoplay.
    mm.add('(prefers-reduced-motion: reduce)', () => {
        gsap.set(['.menu-hero-eyebrow', '.menu-hero-title', '.menu-hero-sub', '.menu-slide-label-wrap', '.carousel-dots'], { opacity: 1 });
        cards.forEach((card, i) => {
            const slot = CAROUSEL_CONFIG.slots[getSlotIndex(i, activeIndex, totalSlides)];
            gsap.set(card, { x: slot.tx, z: slot.tz, rotationY: slot.ry, scale: slot.scale, opacity: slot.opacity, zIndex: Math.round(slot.opacity * 10) });
        });
    });

    // ── Click / dots / arrows ──
    let suppressClick = false;

    cards.forEach((card) => {
        card.addEventListener('click', () => {
            if (suppressClick) {
                return;
            }
            const idx = Number.parseInt(card.dataset.index, 10);
            if (idx !== activeIndex) {
                goToSlide(idx, cards, dots, slideLabel);
            }
        });
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            goToSlide(Number.parseInt(dot.dataset.index, 10), cards, dots, slideLabel);
        });
    });

    prevBtn?.addEventListener('click', () => {
        goToSlide((activeIndex - 1 + totalSlides) % totalSlides, cards, dots, slideLabel);
    });

    nextBtn?.addEventListener('click', () => {
        goToSlide((activeIndex + 1) % totalSlides, cards, dots, slideLabel);
    });

    // ── Keyboard (focus is on a card; events bubble to the stage) ──
    stage?.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            goToSlide((activeIndex - 1 + totalSlides) % totalSlides, cards, dots, slideLabel);
        }
        if (e.key === 'ArrowRight') {
            goToSlide((activeIndex + 1) % totalSlides, cards, dots, slideLabel);
        }
    });

    // ── Drag / swipe (suppresses the trailing click so a swipe isn't also a card tap) ──
    let dragStartX = 0;
    let isDragging = false;

    stage?.addEventListener('pointerdown', (e) => {
        dragStartX = e.clientX;
        isDragging = true;
        suppressClick = false;
    });

    stage?.addEventListener('pointerup', (e) => {
        if (!isDragging) {
            return;
        }
        isDragging = false;

        const delta = e.clientX - dragStartX;
        if (Math.abs(delta) < 40) {
            return;
        }

        suppressClick = true;
        setTimeout(() => {
            suppressClick = false;
        }, 100);

        if (delta > 0) {
            goToSlide((activeIndex - 1 + totalSlides) % totalSlides, cards, dots, slideLabel);
        } else {
            goToSlide((activeIndex + 1) % totalSlides, cards, dots, slideLabel);
        }
    });

    // ── Hover: pause autoplay, micro-scale the hovered card ──
    hero?.addEventListener('mouseenter', () => {
        isHovering = true;
        stopAutoPlay();
    });

    hero?.addEventListener('mouseleave', () => {
        isHovering = false;
        startAutoPlay(cards, dots, slideLabel);
    });

    cards.forEach((card) => {
        card.addEventListener('mouseenter', () => {
            const idx = Number.parseInt(card.dataset.index, 10);
            const slot = CAROUSEL_CONFIG.slots[getSlotIndex(idx, activeIndex, totalSlides)];
            gsap.to(card, { scale: idx === activeIndex ? 1.04 : slot.scale * 1.05, duration: 0.3, ease: 'power2.out', overwrite: 'auto' });
        });

        card.addEventListener('mouseleave', () => {
            const idx = Number.parseInt(card.dataset.index, 10);
            const slot = CAROUSEL_CONFIG.slots[getSlotIndex(idx, activeIndex, totalSlides)];
            gsap.to(card, { scale: slot.scale, duration: 0.3, ease: 'power2.out', overwrite: 'auto' });
        });
    });
}

document.fonts.ready.then(() => {
    initMenuCarousel();
});
