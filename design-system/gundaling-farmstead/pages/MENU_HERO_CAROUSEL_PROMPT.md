# Menu Page Hero — 3D Playful Carousel
# Gundaling Farmstead · GSAP · CSS 3D Transform · Laravel Blade

---

## WHAT TO BUILD

A cinematic 3D coverflow-style carousel hero for the menu page.
7 real food photos arranged in a circular/arc formation in 3D space.
The active card sits front-and-center, large and sharp.
Side cards recede in 3D perspective, smaller and slightly blurred.
Auto-rotates every 4 seconds. Pauseable on hover.
Headline text reacts to each slide with a stagger-reveal.
The whole section sits above the Karo spice parallax background.

---

## PHOTO ASSETS & SLIDE DATA

All photos in: public/images/menu/hero
Files: aab_menu-1.jpg through aab_menu-7.jpg

SLIDE ORDER AND CONTENT (hardcoded in Blade — not from DB):

```php
// In menu.blade.php — define this array at top of hero section
$heroSlides = [
  [
    'img'     => 'aab_menu-2.jpg',
    'label'   => 'Wood-fire · Cheese',
    'title'   => 'Pizza from our own oven.',
    'desc'    => 'House mozzarella. Farm sausage. Charred crust.',
    'color'   => '#F5C542',   // gold — warm cheese tones
  ],
  [
    'img'     => 'aab_menu-4.jpg',
    'label'   => 'Cheese Vault',
    'title'   => 'Five cheeses. All made here.',
    'desc'    => 'Aged on-farm. Paired with fruit from our garden.',
    'color'   => '#E8943A',   // amber
  ],
  [
    'img'     => 'aab_menu-3.jpg',
    'label'   => 'Pasta · Western',
    'title'   => 'Pesto fettuccine, farm style.',
    'desc'    => 'House-made pasta. Basil from the garden. Gundaling cheese.',
    'color'   => '#6BA44E',   // farm green — pesto
  ],
  [
    'img'     => 'aab_menu-1.jpg',
    'label'   => 'Taste of Karo',
    'title'   => 'Nasi goreng sapi panggang.',
    'desc'    => 'Karo grilled beef. Sambal hijau. Egg fresh from the farm.',
    'color'   => '#D4520E',   // fire — earthy Karo tones
  ],
  [
    'img'     => 'aab_menu-6.jpg',
    'label'   => 'Dessert',
    'title'   => 'Panna cotta. Farm milk.',
    'desc'    => 'Strawberry compote. Tamarillo chip. Fresh flowers.',
    'color'   => '#C084B8',   // soft pink — flower/dessert
  ],
  [
    'img'     => 'aab_menu-5.jpg',
    'label'   => 'Cheese Board',
    'title'   => 'The full cheese experience.',
    'desc'    => 'Tamarillo jam. Crackers. Passionfruit. Five varieties.',
    'color'   => '#A8876E',   // tan — aged cheese
  ],
  [
    'img'     => 'aab_menu-7.jpg',
    'label'   => 'Dessert · Signature',
    'title'   => 'Every plate tells a story.',
    'desc'    => 'Plated by hand. Grown from the soil. Made with care.',
    'color'   => '#765F52',   // warm brown
  ],
];
```

---

## HTML STRUCTURE (menu/index.blade.php — hero section)

```html
{{-- ============================================================
     MENU PAGE HERO — 3D CAROUSEL
     ============================================================ --}}
<section id="menu-hero" class="menu-hero" aria-label="Menu highlights">

  {{-- Dark overlay gradient at bottom so text is always readable --}}
  <div class="menu-hero-overlay"></div>

  {{-- ── HEADLINE (left-aligned, reacts to slide changes) ── --}}
  <div class="menu-hero-text" aria-live="polite">
    <p class="menu-hero-eyebrow">
      <span class="eyebrow-dot"></span>
      Farm to Table · Berastagi
    </p>
    <h1 class="menu-hero-title">Our Menu</h1>
    <p class="menu-hero-sub">
      Honest ingredients. Open kitchen.<br>
      Every dish grown or raised steps from your seat.
    </p>

    {{-- Dynamic slide label that changes with active card --}}
    <div class="menu-slide-label-wrap">
      <span class="menu-slide-label" id="slideLabel">Wood-fire · Cheese</span>
    </div>

    {{-- Progress dots --}}
    <div class="carousel-dots" role="tablist" aria-label="Menu slides">
      @foreach($heroSlides as $i => $slide)
        <button
          class="carousel-dot {{ $i === 0 ? 'active' : '' }}"
          role="tab"
          aria-label="Slide {{ $i + 1 }}"
          data-index="{{ $i }}"
        ></button>
      @endforeach
    </div>
  </div>

  {{-- ── 3D CAROUSEL STAGE ── --}}
  <div class="carousel-stage-wrap">
    <div class="carousel-stage" id="carouselStage">

      @foreach($heroSlides as $i => $slide)
        <div
          class="carousel-card {{ $i === 0 ? 'is-active' : '' }}"
          data-index="{{ $i }}"
          data-color="{{ $slide['color'] }}"
          data-label="{{ $slide['label'] }}"
          data-title="{{ $slide['title'] }}"
          data-desc="{{ $slide['desc'] }}"
          role="tab"
          tabindex="{{ $i === 0 ? '0' : '-1' }}"
          aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
          aria-label="{{ $slide['label'] }}: {{ $slide['title'] }}"
        >
          {{-- Food photo --}}
          <img
            src="{{ asset('images/menu/' . $slide['img']) }}"
            alt="{{ $slide['title'] }}"
            class="carousel-card-img"
            loading="{{ $i < 3 ? 'eager' : 'lazy' }}"
            width="640"
            height="480"
          >

          {{-- Card label overlay at bottom --}}
          <div class="carousel-card-overlay">
            <span class="card-label">{{ $slide['label'] }}</span>
          </div>

          {{-- Colored accent glow matching dish palette --}}
          <div class="card-glow" style="--glow-color: {{ $slide['color'] }}"></div>
        </div>
      @endforeach

    </div>

    {{-- Prev / Next arrows --}}
    <button class="carousel-arrow carousel-prev" id="carouselPrev" aria-label="Previous dish">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M12 4L6 10L12 16" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    <button class="carousel-arrow carousel-next" id="carouselNext" aria-label="Next dish">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
        <path d="M8 4L14 10L8 16" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
  </div>

</section>
```

---

## CSS (add to resources/css/menu.css)

```css
/* ============================================================
   MENU HERO — 3D COVERFLOW CAROUSEL
   ============================================================ */

.menu-hero {
  position: relative;
  min-height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  align-items: center;
  gap: 2rem;
  padding: 0 3rem 0 4rem;
  padding-top: 80px; /* nav height */
  background: #0e1810; /* farm-950 */
  overflow: hidden;
}

/* Bottom gradient so text never fights with scroll content below */
.menu-hero-overlay {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse at 20% 50%,
      rgba(14,24,16,0.85) 0%,
      rgba(14,24,16,0.4) 60%,
      transparent 100%);
  z-index: 1;
  pointer-events: none;
}

/* ── TEXT SIDE ── */
.menu-hero-text {
  position: relative;
  z-index: 3;
}

.menu-hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-body);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: #F5C542;
  margin-bottom: 1.2rem;
  opacity: 0; /* GSAP will reveal */
}

.eyebrow-dot {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #F5C542;
  animation: pulseDot 2.2s ease-in-out infinite;
}

@keyframes pulseDot {
  0%,100% { transform: scale(1); opacity: 1; }
  50%      { transform: scale(1.8); opacity: 0.4; }
}

.menu-hero-title {
  font-family: var(--font-display);
  font-size: clamp(3.2rem, 5.5vw, 5.5rem);
  font-weight: 700;
  color: #FFF7ED;
  line-height: 1.0;
  margin-bottom: 1rem;
  opacity: 0; /* GSAP SplitText will reveal */
}

.menu-hero-sub {
  font-family: var(--font-body);
  font-size: 1rem;
  line-height: 1.75;
  color: rgba(255,247,237,0.6);
  max-width: 420px;
  margin-bottom: 1.5rem;
  opacity: 0; /* GSAP will reveal */
}

/* Dynamic label that updates per slide */
.menu-slide-label-wrap {
  margin-bottom: 1.8rem;
  height: 28px; /* fixed height prevents layout shift */
  overflow: hidden;
}

.menu-slide-label {
  display: inline-block;
  font-family: var(--font-body);
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: #FFF7ED;
  background: rgba(255,247,237,0.1);
  border: 1px solid rgba(255,247,237,0.2);
  padding: 5px 14px;
  border-radius: 20px;
}

/* Dot nav */
.carousel-dots {
  display: flex;
  gap: 8px;
  align-items: center;
}

.carousel-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255,247,237,0.25);
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}

.carousel-dot.active {
  width: 24px;
  border-radius: 4px;
  background: #F5C542;
}

/* ── CAROUSEL STAGE ── */
.carousel-stage-wrap {
  position: relative;
  z-index: 2;
  height: 580px;
  display: flex;
  align-items: center;
  justify-content: center;
  /* Enable 3D perspective on the stage */
  perspective: 1200px;
  perspective-origin: 50% 50%;
}

.carousel-stage {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
}

/* ── INDIVIDUAL CARD ── */
.carousel-card {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  height: 480px;
  border-radius: 20px;
  overflow: hidden;
  cursor: pointer;
  /* GSAP controls all transform values — these are just initial state */
  transform: translate(-50%, -50%) translateX(0) translateZ(0) rotateY(0deg);
  transform-style: preserve-3d;
  transition: box-shadow 0.3s ease;
  /* Performance hint */
  will-change: transform, opacity;
}

.carousel-card:hover {
  box-shadow: 0 30px 80px rgba(0,0,0,0.6);
}

.carousel-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  /* Subtle scale on hover handled by GSAP, not CSS */
}

/* Card bottom label */
.carousel-card-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1.5rem 1.2rem 1rem;
  background: linear-gradient(0deg, rgba(0,0,0,0.75) 0%, transparent 100%);
}

.card-label {
  font-family: var(--font-body);
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: rgba(255,247,237,0.85);
}

/* Colored glow behind each card — color comes from dish palette */
.card-glow {
  position: absolute;
  inset: -20px;
  border-radius: 30px;
  background: radial-gradient(ellipse,
    var(--glow-color, #F5C542) 0%,
    transparent 65%);
  opacity: 0; /* GSAP fades this in on active card */
  z-index: -1;
  filter: blur(30px);
}

/* Arrows */
.carousel-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 10;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: rgba(255,247,237,0.1);
  border: 1px solid rgba(255,247,237,0.2);
  color: #FFF7ED;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s, transform 0.2s;
  backdrop-filter: blur(8px);
}

.carousel-arrow:hover {
  background: rgba(245,197,66,0.2);
  border-color: rgba(245,197,66,0.4);
  transform: translateY(-50%) scale(1.08);
}

.carousel-prev { left: 0.5rem; }
.carousel-next { right: 0.5rem; }

/* ── MOBILE ── */
@media (max-width: 1024px) {
  .menu-hero {
    grid-template-columns: 1fr;
    padding: 5rem 1.5rem 3rem;
    min-height: auto;
  }
  .menu-hero-text {
    text-align: center;
  }
  .carousel-dots { justify-content: center; }
  .menu-hero-sub { margin: 0 auto 1.5rem; }
  .carousel-stage-wrap { height: 380px; }
  .carousel-card { width: 280px; height: 336px; }
}

@media (max-width: 540px) {
  .carousel-stage-wrap { height: 300px; }
  .carousel-card { width: 230px; height: 276px; }
  .carousel-arrow { display: none; }
}
```

---

## JAVASCRIPT (resources/js/menu-carousel.js)

```javascript
/**
 * MENU HERO — 3D COVERFLOW CAROUSEL
 * Gundaling Farmstead · GSAP + ScrollTrigger
 *
 * 3D layout: cards arranged in an arc.
 * Active card: front-center, full opacity, sharp.
 * Side cards: recede in Z, rotated in Y, dimmed, blurred.
 * Far cards: hidden (opacity 0) to save render cost.
 */

// ── CONFIG ──────────────────────────────────────────────────────
const CAROUSEL_CONFIG = {
  autoPlayDelay : 4500,    // ms between auto-advances
  transitionDur : 0.65,    // seconds — card position transition
  textDur       : 0.5,     // seconds — headline text swap

  // 3D position map for each "slot" offset from center (index 0 = active)
  // Positions for 7 cards total — center is index 0
  slots: [
    // offset: [translateX, translateZ, rotateY, scale, opacity, blur]
    { tx:    0, tz:  150, ry:   0, scale: 1.00, opacity: 1.00, blur: 0  }, // active
    { tx:  380, tz:  -40, ry: -28, scale: 0.82, opacity: 0.75, blur: 1  }, // right-1
    { tx:  620, tz: -140, ry: -42, scale: 0.66, opacity: 0.45, blur: 3  }, // right-2
    { tx:  760, tz: -220, ry: -52, scale: 0.52, opacity: 0.00, blur: 6  }, // right-3 (hidden)
    { tx: -380, tz:  -40, ry:  28, scale: 0.82, opacity: 0.75, blur: 1  }, // left-1
    { tx: -620, tz: -140, ry:  42, scale: 0.66, opacity: 0.45, blur: 3  }, // left-2
    { tx: -760, tz: -220, ry:  52, scale: 0.52, opacity: 0.00, blur: 6  }, // left-3 (hidden)
  ],

  ease       : "power3.out",
  easeSpring : "back.out(1.4)",
};

// ── STATE ────────────────────────────────────────────────────────
let activeIndex = 0;
let totalSlides = 0;
let autoPlayTimer = null;
let isAnimating = false;

// ── INIT ─────────────────────────────────────────────────────────
function initMenuCarousel() {
  const cards  = document.querySelectorAll(".carousel-card");
  const dots   = document.querySelectorAll(".carousel-dot");
  const stage  = document.getElementById("carouselStage");
  const prevBtn = document.getElementById("carouselPrev");
  const nextBtn = document.getElementById("carouselNext");
  const slideLabel = document.getElementById("slideLabel");

  if (!cards.length) return;

  totalSlides = cards.length;

  // ── ENTRANCE ANIMATION ──────────────────────────────────────
  // Stagger headline text in on load
  const mm = gsap.matchMedia();
  mm.add("(prefers-reduced-motion: no-preference)", () => {

    // Eyebrow
    gsap.to(".menu-hero-eyebrow", {
      opacity: 1, y: 0, duration: 0.7, ease: "power2.out", delay: 0.2
    });
    gsap.from(".menu-hero-eyebrow", { y: 20 });

    // Title — SplitText word reveal
    if (typeof SplitText !== "undefined") {
      const split = new SplitText(".menu-hero-title", { type: "words" });
      gsap.set(".menu-hero-title", { opacity: 1 });
      gsap.from(split.words, {
        y: 60, opacity: 0, duration: 0.75, stagger: 0.07,
        ease: "power3.out", delay: 0.35
      });
    } else {
      // Fallback without SplitText
      gsap.to(".menu-hero-title", {
        opacity: 1, y: 0, duration: 0.8, ease: "power3.out", delay: 0.35
      });
      gsap.from(".menu-hero-title", { y: 40 });
    }

    // Subtitle
    gsap.to(".menu-hero-sub", {
      opacity: 1, y: 0, duration: 0.7, ease: "power2.out", delay: 0.65
    });
    gsap.from(".menu-hero-sub", { y: 24 });

    // Slide label + dots
    gsap.to([".menu-slide-label-wrap", ".carousel-dots"], {
      opacity: 1, y: 0, duration: 0.6, ease: "power2.out",
      delay: 0.8, stagger: 0.1
    });
    gsap.from([".menu-slide-label-wrap", ".carousel-dots"], { y: 16, opacity: 0 });

    // Cards entrance — stagger from right
    cards.forEach((card, i) => {
      gsap.from(card, {
        opacity: 0,
        scale: 0.7,
        rotationY: -30,
        duration: 0.9,
        delay: 0.5 + i * 0.06,
        ease: "back.out(1.2)",
      });
    });

    // ── SET INITIAL 3D POSITIONS ────────────────────────────
    setCardPositions(cards, 0, false);

  }); // end matchMedia

  // Reduced-motion fallback — no 3D, just show active card
  mm.add("(prefers-reduced-motion: reduce)", () => {
    gsap.set([".menu-hero-eyebrow",".menu-hero-title",".menu-hero-sub",
              ".menu-slide-label-wrap",".carousel-dots"], { opacity: 1 });
    cards.forEach((card, i) => {
      gsap.set(card, {
        opacity: i === 0 ? 1 : 0,
        scale: i === 0 ? 1 : 0,
      });
    });
  });

  // ── CLICK HANDLERS ──────────────────────────────────────────
  cards.forEach((card) => {
    card.addEventListener("click", () => {
      const idx = parseInt(card.dataset.index);
      if (idx !== activeIndex) goToSlide(idx, cards, dots, slideLabel);
    });
  });

  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      const idx = parseInt(dot.dataset.index);
      goToSlide(idx, cards, dots, slideLabel);
    });
  });

  prevBtn?.addEventListener("click", () => {
    const prev = (activeIndex - 1 + totalSlides) % totalSlides;
    goToSlide(prev, cards, dots, slideLabel);
  });

  nextBtn?.addEventListener("click", () => {
    const next = (activeIndex + 1) % totalSlides;
    goToSlide(next, cards, dots, slideLabel);
  });

  // Keyboard navigation
  stage?.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft")  {
      const prev = (activeIndex - 1 + totalSlides) % totalSlides;
      goToSlide(prev, cards, dots, slideLabel);
    }
    if (e.key === "ArrowRight") {
      const next = (activeIndex + 1) % totalSlides;
      goToSlide(next, cards, dots, slideLabel);
    }
  });

  // ── DRAG / SWIPE ────────────────────────────────────────────
  let dragStartX = 0;
  let isDragging = false;

  stage?.addEventListener("pointerdown", (e) => {
    dragStartX = e.clientX;
    isDragging = true;
  });

  stage?.addEventListener("pointerup", (e) => {
    if (!isDragging) return;
    isDragging = false;
    const delta = e.clientX - dragStartX;
    if (Math.abs(delta) < 40) return; // minimum swipe distance

    if (delta > 0) {
      const prev = (activeIndex - 1 + totalSlides) % totalSlides;
      goToSlide(prev, cards, dots, slideLabel);
    } else {
      const next = (activeIndex + 1) % totalSlides;
      goToSlide(next, cards, dots, slideLabel);
    }
  });

  // ── HOVER PAUSE ─────────────────────────────────────────────
  const hero = document.getElementById("menu-hero");
  hero?.addEventListener("mouseenter", () => stopAutoPlay());
  hero?.addEventListener("mouseleave", () => startAutoPlay(cards, dots, slideLabel));

  // ── CARD HOVER MICRO-ANIMATION ───────────────────────────────
  cards.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      gsap.to(card, {
        scale: card === cards[activeIndex] ? 1.04 : 0.87,
        duration: 0.3,
        ease: "power2.out",
        overwrite: "auto",
      });
    });
    card.addEventListener("mouseleave", () => {
      // Return to proper slot scale
      const slotIdx = getSlotIndex(parseInt(card.dataset.index), activeIndex, totalSlides);
      const slot = CAROUSEL_CONFIG.slots[slotIdx] || CAROUSEL_CONFIG.slots[3];
      gsap.to(card, {
        scale: slot.scale,
        duration: 0.3,
        ease: "power2.out",
        overwrite: "auto",
      });
    });
  });

  // ── START AUTOPLAY ───────────────────────────────────────────
  startAutoPlay(cards, dots, slideLabel);
}


// ── SLIDE TRANSITION ─────────────────────────────────────────────
function goToSlide(newIndex, cards, dots, slideLabel) {
  if (isAnimating || newIndex === activeIndex) return;
  isAnimating = true;

  stopAutoPlay();
  const prevIndex = activeIndex;
  activeIndex = newIndex;

  // Update ARIA
  cards.forEach((c, i) => {
    c.setAttribute("aria-selected", i === newIndex ? "true" : "false");
    c.setAttribute("tabindex",      i === newIndex ? "0" : "-1");
  });

  // Update dots
  dots.forEach((d, i) => {
    d.classList.toggle("active", i === newIndex);
  });

  // Animate cards to new 3D positions
  setCardPositions(cards, newIndex, true);

  // ── TEXT SWAP ───────────────────────────────────────────────
  const activeCard = cards[newIndex];
  const newLabel  = activeCard.dataset.label;
  const newColor  = activeCard.dataset.color;

  // Animate label swap (slide up old, slide in new)
  gsap.to(slideLabel, {
    y: -20, opacity: 0, duration: 0.2, ease: "power2.in",
    onComplete: () => {
      slideLabel.textContent = newLabel;
      // Update label border color to match dish palette
      slideLabel.style.borderColor = newColor + "55";
      slideLabel.style.background  = newColor + "18";
      gsap.fromTo(slideLabel,
        { y: 20, opacity: 0 },
        { y: 0, opacity: 1, duration: 0.35, ease: "power2.out" }
      );
    }
  });

  // Unlock after longest tween finishes
  gsap.delayedCall(CAROUSEL_CONFIG.transitionDur + 0.1, () => {
    isAnimating = false;
    startAutoPlay(cards, dots, slideLabel);
  });
}


// ── POSITION ALL CARDS IN 3D SPACE ───────────────────────────────
function setCardPositions(cards, centerIndex, animate) {
  const cfg = CAROUSEL_CONFIG;

  cards.forEach((card, cardIdx) => {
    const slotIdx = getSlotIndex(cardIdx, centerIndex, cards.length);
    const slot = cfg.slots[slotIdx] || cfg.slots[3]; // fallback to hidden

    const isActive = cardIdx === centerIndex;
    const glow     = card.querySelector(".card-glow");

    const tweenProps = {
      x         : slot.tx,
      z         : slot.tz,
      rotationY : slot.ry,
      scale     : slot.scale,
      opacity   : slot.opacity,
      filter    : `blur(${slot.blur}px)`,
      duration  : animate ? cfg.transitionDur : 0,
      ease      : animate ? cfg.ease : "none",
      zIndex    : Math.round(slot.opacity * 10),
      overwrite : "auto",
    };

    // Active card gets a spring bounce entry
    if (isActive && animate) {
      tweenProps.ease = cfg.easeSpring;
    }

    gsap.to(card, tweenProps);

    // Glow — only on active card
    if (glow) {
      gsap.to(glow, {
        opacity   : isActive ? 0.35 : 0,
        duration  : animate ? 0.5 : 0,
        ease      : "power2.out",
        overwrite : "auto",
      });
    }
  });
}


// ── SLOT INDEX CALCULATION ────────────────────────────────────────
// Returns which visual slot (0=center, 1=right-1, 2=right-2 etc.)
// a card should occupy given the current activeIndex
function getSlotIndex(cardIdx, centerIndex, total) {
  let offset = cardIdx - centerIndex;

  // Wrap around
  if (offset > total / 2)  offset -= total;
  if (offset < -total / 2) offset += total;

  // Map offset to slot index
  // offset  0 → slot 0 (active center)
  // offset  1 → slot 1 (right-1)
  // offset  2 → slot 2 (right-2)
  // offset  3 → slot 3 (right-3, hidden)
  // offset -1 → slot 4 (left-1)
  // offset -2 → slot 5 (left-2)
  // offset -3 → slot 6 (left-3, hidden)
  const map = { 0:0, 1:1, 2:2, 3:3, [-1]:4, [-2]:5, [-3]:6 };
  return map[offset] !== undefined ? map[offset] : 3; // fallback hidden
}


// ── AUTOPLAY ─────────────────────────────────────────────────────
function startAutoPlay(cards, dots, slideLabel) {
  stopAutoPlay();
  autoPlayTimer = setInterval(() => {
    const next = (activeIndex + 1) % totalSlides;
    goToSlide(next, cards, dots, slideLabel);
  }, CAROUSEL_CONFIG.autoPlayDelay);
}

function stopAutoPlay() {
  if (autoPlayTimer) {
    clearInterval(autoPlayTimer);
    autoPlayTimer = null;
  }
}


// ── BOOT ─────────────────────────────────────────────────────────
// Wait for DOM + fonts before initialising
document.addEventListener("DOMContentLoaded", () => {
  document.fonts.ready.then(() => {
    initMenuCarousel();
  });
});
```

---

## LARAVEL INTEGRATION

In `resources/js/app.js`, import menu carousel ONLY on menu page:
```javascript
// Conditional load — only loads on menu page DOM
if (document.getElementById("menu-hero")) {
  import("./menu-carousel.js");
}
```

In `menu.blade.php` `<head>`:
```html
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endpush
```

At bottom of `menu.blade.php` before `</body>`:
```html
@push('scripts')
  {{-- GSAP core + ScrollTrigger + SplitText --}}
  {{-- These should already be in app.js/app.css via Vite --}}
  {{-- SplitText is a GSAP Club plugin — use CDN trial or purchase --}}
  {{-- Fallback in JS handles the case where SplitText is unavailable --}}
@endpush
```

---

## PHOTO OPTIMIZATION (run before deploy)

```bash
# Install sharp CLI for batch resize
npm install -g sharp-cli

# Resize all menu photos to max 1280px wide, keep quality at 82%
# Original files are 7–10MB — target is under 300KB per image
mkdir -p public/images/menu

for i in 1 2 3 4 5 6 7; do
  sharp \
    -i "resources/images/aab_menu-${i}.jpg" \
    -o "public/images/menu/aab_menu-${i}.jpg" \
    resize 1280 \
    --quality 82
done

# Check output sizes
ls -lh public/images/menu/
# Target: each file under 300KB
```

Alternative: use Laravel's `spatie/laravel-image-optimizer` or
just manually resize in Photoshop/Squoosh.app before upload.

---

## QUALITY CHECKLIST

[ ] $heroSlides array defined at top of menu.blade.php hero section
[ ] All 7 aab_menu-*.jpg files in public/images/menu/ (OPTIMIZED, <300KB each)
[ ] loading="eager" on first 3 cards, loading="lazy" on cards 4–7
[ ] GSAP matchMedia wraps ALL animation code
[ ] prefers-reduced-motion: static opacity-only fallback works
[ ] Autoplay pauses on mouse hover over #menu-hero
[ ] Keyboard: ArrowLeft/ArrowRight navigate between slides
[ ] Drag/swipe: works on touch devices (min 40px swipe)
[ ] isAnimating flag prevents rapid-click jank
[ ] Card glow color matches each dish's palette ($slide['color'])
[ ] Slide label updates with color-matched border/bg tint
[ ] Dot nav updates correctly on every slide change
[ ] ARIA attributes: aria-selected, aria-live="polite", aria-label
[ ] Z-index: active card always on top, far cards below
[ ] Mobile (≤1024px): single column layout, carousel still works
[ ] Mobile (≤540px): arrows hidden, swipe only
[ ] Carousel arrows keyboard accessible (Tab-able, Enter to activate)
[ ] SplitText fallback: if unavailable, title still reveals cleanly
[ ] Photos optimized: each under 300KB (not the original 7–10MB)
[ ] menu-carousel.js only loads when #menu-hero is present in DOM
