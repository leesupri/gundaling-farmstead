import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import { animate, scroll, inView, stagger } from 'motion';

window.Alpine = Alpine;
Alpine.plugin(intersect);
Alpine.start();

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!reducedMotion) {
    const heroBg = document.querySelector('.hero-bg');
    if (heroBg) {
        scroll(animate(heroBg, { y: [0, -120] }), {
            target: document.querySelector('#hero'),
        });
    }

    inView('.scene', ({ target }) => {
        const img = target.querySelector('.scene-img');
        const text = target.querySelector('.scene-text');

        if (img) {
            animate(img, { opacity: [0, 1], x: [-60, 0] }, {
                duration: 0.8,
                easing: [0.25, 0.46, 0.45, 0.94],
            });
        }

        if (text) {
            animate(text, { opacity: [0, 1], x: [60, 0] }, {
                duration: 0.8,
                delay: 0.15,
                easing: [0.25, 0.46, 0.45, 0.94],
            });
        }
    });

    inView('.cheese-grid', ({ target }) => {
        animate(target.querySelectorAll('.cheese-card'), { opacity: [0, 1], y: [40, 0] }, {
            duration: 0.6,
            delay: stagger(0.12),
        });
    });

    inView('.menu-grid', ({ target }) => {
        animate(target.querySelectorAll('.menu-item-card'), { opacity: [0, 1], y: [20, 0] }, {
            duration: 0.5,
            delay: stagger(0.08),
        });
    });

    inView('.promo-grid', ({ target }) => {
        animate(target.querySelectorAll('.promo-card'), { opacity: [0, 1], y: [30, 0] }, {
            duration: 0.5,
            delay: stagger(0.1),
        });
    });

    document.querySelectorAll('.mascot-idle').forEach((el) => {
        animate(el, { y: [0, -10, 0] }, { duration: 3.6, repeat: Infinity, easing: 'ease-in-out' });
    });

    const walkMascot = document.querySelector('.walk-mascot');
    if (walkMascot) {
        animate(walkMascot, { x: [-80, window.innerWidth + 80] }, { duration: 14, repeat: Infinity, easing: 'linear' });
    }

    const timelineLine = document.querySelector('.timeline-connector');
    if (timelineLine) {
        inView(timelineLine, ({ target }) => {
            animate(target, { clipPath: ['inset(0 100% 0 0)', 'inset(0 0% 0 0)'] }, { duration: 1.2, easing: 'ease-out' });
        });
    }
}
