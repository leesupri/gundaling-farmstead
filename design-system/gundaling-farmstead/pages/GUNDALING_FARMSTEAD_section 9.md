# GUNDALING FARMSTEAD — UI/UX BUILD PROMPT
## Brand: Farm to Table Restaurant · Berastagi Highland
## Skills: emilkowalski/skills · taste-skill · impeccable · GSAP

---

## IDENTITY STATEMENT

> "Reading this as: **premium farm-to-table restaurant website** for urban food-lovers,
> families, and weekend visitors from Medan, with a **warm highland editorial** language —
> think Noma meets Karo highlands. Leaning toward GSAP ScrollTrigger + Lenis + Tailwind
> CSS + organic serif display type on a dark soil background."

**Brand name:** Gundaling Farmstead
**Parent company:** PT Anugerah Alam Berastagi
**Concept:** Farm to table — ingredients grown, raised, and harvested on-site,
plated the same day in the open-air restaurant
**Location:** Berastagi, Karo Highlands, North Sumatra — 1,300 m elevation
**Atmosphere:** Big red A-frame roof, open field, garden pond, cypress trees,
panoramic view of Mount Sibayak
**Sister brand:** Gundaling Farm (dairy/cattle) — linked but separate site

**Stack:** Laravel Blade · Tailwind CSS · GSAP · Lenis · Vanilla JS
**Hosting:** Rumahweb shared cPanel/Apache — no Node SSR

---

## TASTE-SKILL DIALS

```
DESIGN_VARIANCE  = 7   // Asymmetric grids, overlapping photo bleeds, broken baseline
MOTION_INTENSITY = 8   // GSAP parallax, sticky stack, scrub word reveal, image scale
VISUAL_DENSITY   = 3   // Spacious. One cinematic moment per viewport. Luxury/artisan feel.
```

---

## BRAND COLOUR TOKENS

```css
:root {
  /* Farmstead palette — warm soil, evening fire, highland green */
  --fs-soil:      #1A0F08;   /* darkest bg — like rich volcanic earth */
  --fs-bark:      #2C1A0E;   /* section bg alternating — tree bark brown */
  --fs-forest:    #1E3A22;   /* card surfaces — deep pine forest */
  --fs-moss:      #4A7C3A;   /* accents, tags — highland moss */
  --fs-ember:     #C0724A;   /* PRIMARY accent — Sibayak sunset ember */
  --fs-harvest:   #D4A847;   /* SECONDARY accent — harvest gold, headings */
  --fs-cream:     #F5EDD8;   /* body text on dark — warm cream parchment */
  --fs-mist:      #B8C8B0;   /* muted text — highland morning mist */
  --fs-white:     #FAF8F3;   /* brightest surface — clean linen */
}
```

---

## TYPOGRAPHY

```css
--font-display: 'Playfair Display', Georgia, serif;
/* Used for: hero H1, section titles, pull quotes — editorial weight, organic */

--font-body:    'DM Sans', system-ui, sans-serif;
/* Used for: body copy, nav, UI labels, descriptions — warm and legible */

--font-stamp:   'DM Mono', monospace;
/* Used for: coordinates, price tags, date stamps, location tags */
```

**Scale:**
```
Hero H1      clamp(3.5rem, 8vw, 7rem)   · weight 700 · line-height 0.92 · tracking -0.03em
Section H2   clamp(2rem, 4vw, 3.5rem)   · weight 600 · line-height 1.1
Subhead      clamp(1rem, 2vw, 1.25rem)  · weight 400 · line-height 1.6
Body         1.125rem                   · weight 400 · line-height 1.75 · max 65ch
Caption      0.75rem                    · weight 500 · tracking 0.12em · UPPERCASE
```

---

## GSAP + LENIS BOILERPLATE *(layout.blade.php — load once)*

```html
<!-- CDN order matters: GSAP core → ScrollTrigger → Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>
```

```js
// Smooth scroll with cinematic inertia
const lenis = new Lenis({ lerp: 0.08, smoothWheel: true });

// Sync Lenis ↔ GSAP ticker
gsap.ticker.add((time) => lenis.raf(time * 1000));
gsap.ticker.lagSmoothing(0);
lenis.on('scroll', ScrollTrigger.update);
ScrollTrigger.scrollerProxy(document.body, {
  scrollTop(value) {
    return arguments.length ? lenis.scrollTo(value) : lenis.scroll;
  },
  getBoundingClientRect() {
    return { top: 0, left: 0, width: window.innerWidth, height: window.innerHeight };
  }
});
```

---

## PAGE SECTIONS — GUNDALING FARMSTEAD

---

### SECTION 01 · HERO
**Concept:** First breath of mountain air. Full-screen cinematic opener.

**Photo needed:** ✅ USE `wINdownhoUSe_PIMS-1.JPG`
(aerial/elevated view of the farmstead buildings with Sibayak at blue hour / sunset)

**Layout:**
```
┌─────────────────────────────────────────────┐
│  [Mount Sibayak photo — full bleed bg]       │
│                                              │
│                                              │
│  ┌──────────────────────────────────────┐   │
│  │ [eyebrow]  1.300 m · Berastagi       │   │
│  │ [H1]       Dari Ladang,              │   │
│  │            Ke Meja Anda.             │   │
│  │ [sub]      Hidangan segar. Setiap hari. │ │
│  │ [CTA btn]  Lihat Menu  →             │   │
│  └──────────────────────────────────────┘   │
│                                   bottom-left│
└─────────────────────────────────────────────┘
```
Text anchored BOTTOM-LEFT. NOT centered (centered = generic AI default).
Dark gradient overlay: linear from transparent (top) → 70% opacity soil (bottom-left corner only).

**GSAP — entrance (ease-out on ALL enter animations, never ease-in):**
```js
const tl = gsap.timeline({ delay: 0.3 });
tl.from(".hero-eyebrow", { y: 24, opacity: 0, duration: 0.7, ease: "power3.out" })
  .from(".hero-h1",      { y: 60, opacity: 0, duration: 1.0, ease: "power3.out" }, "-=0.4")
  .from(".hero-sub",     { y: 20, opacity: 0, duration: 0.7, ease: "power3.out" }, "-=0.5")
  .from(".hero-cta",     { y: 16, opacity: 0, duration: 0.6, ease: "power3.out" }, "-=0.4");

// Parallax — photo drifts slower than the page scroll
gsap.to(".hero-bg-img", {
  yPercent: 28,
  ease: "none",
  scrollTrigger: {
    trigger: ".hero",
    start: "top top",
    end: "bottom top",
    scrub: true
  }
});
```

**CTA Button — directional hover fill (Emil micro-interaction):**
```js
// Fill enters from the exact side the mouse entered
document.querySelectorAll(".btn-farmstead").forEach(btn => {
  btn.addEventListener("mouseenter", (e) => {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const fromLeft = x < rect.width / 2;
    gsap.fromTo(btn.querySelector(".btn-fill"),
      { scaleX: 0, transformOrigin: fromLeft ? "left" : "right" },
      { scaleX: 1, duration: 0.35, ease: "power2.out" }
    );
  });
  btn.addEventListener("mouseleave", (e) => {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const toLeft = x < rect.width / 2;
    gsap.to(btn.querySelector(".btn-fill"),
      { scaleX: 0, transformOrigin: toLeft ? "left" : "right",
        duration: 0.3, ease: "power2.in" }
    );
  });
});
```

---

### SECTION 02 · WHAT IS FARM TO TABLE
**Concept:** One-liner philosophy. Large editorial type. Breathing room.

**Layout:** Full-width. Dark soil bg. Single pull-quote centred, then a 2-col asymmetric
split below (text 40% left, large photo 60% right — photo bleeds to edge).

**Photo needed:** ✅ USE `1782545629304_resto_farm.PNG`
(restaurant building with open garden — daytime establishing shot)

**GSAP — scrubbed word reveal (Emil technique):**
```js
// Wrap each word in <span>, reveal as user scrolls into section
const words = document.querySelectorAll(".philosophy-text span");
gsap.fromTo(words,
  { opacity: 0.08, y: 8 },
  {
    opacity: 1, y: 0,
    stagger: 0.06,
    ease: "none",
    scrollTrigger: {
      trigger: ".philosophy",
      start: "top 70%",
      end: "center 40%",
      scrub: 1.2
    }
  }
);
```

**Copy:**
```
[pull-quote]
"Pagi dipetik. Siang diolah. Sore tersaji."

[body]
Gundaling Farmstead bukan sekadar restoran. Kami adalah
ujung dari perjalanan panjang — dari ladang vulkanik Karo,
kandang sapi FH kami, hingga dapur terbuka yang menghadap
Gunung Sibayak.
```

---

### SECTION 03 · FARM TO TABLE JOURNEY — Sticky Scroll Stack
**Concept:** THE signature interaction. 5 cards pin and stack as user scrolls.
Each card = one stage of the farm-to-table chain, with photo.

**Photos needed — one photo per card:**
```
Card 1 · LAHAN    → aerial or wide field photo (use DJI_0067.JPG)
Card 2 · KEBUN    → close-up vegetables/herbs growing
Card 3 · KANDANG  → sapi FH at Gundaling Farm (use 1782545445058_DJI_0026.JPG)
Card 4 · DAPUR    → kitchen or food preparation photo
Card 5 · MEJA     → plated dish on restaurant table
```

**Card layout (each card is full-viewport):**
```
┌─────────────────────────────────────────────┐
│  [Photo — left 55%]  │  [Content — right 45%] │
│                       │                       │
│                       │  [stage tag] 01/05    │
│                       │  [H2] Lahan Vulkanik  │
│                       │  [body] Tanah Karo...  │
│                       │  [thin progress bar]   │
└─────────────────────────────────────────────┘
```

**GSAP Sticky-Stack — canonical (start MUST be "top top"):**
```js
const cards = gsap.utils.toArray(".journey-card");

cards.forEach((card, i) => {
  // Pin each card at viewport top
  ScrollTrigger.create({
    trigger: card,
    start: "top top",   // CRITICAL — not "top center", not "top 80%"
    pin: true,
    pinSpacing: false,
    id: `card-${i}`
  });

  // Card enters from below with slight scale — feels like it rises up
  if (i > 0) {
    gsap.from(card, {
      yPercent: 8,
      scale: 0.96,
      opacity: 0,
      duration: 0.7,
      ease: "power2.out",
      scrollTrigger: {
        trigger: card,
        start: "top 90%",
        toggleActions: "play none none reverse"
      }
    });
  }

  // Photo parallax within each card
  gsap.to(card.querySelector(".card-photo"), {
    yPercent: -12,
    ease: "none",
    scrollTrigger: {
      trigger: card,
      start: "top top",
      end: "bottom top",
      scrub: true
    }
  });
});
```

**Card content:**
```
Card 1 — LAHAN       "Dimulai dari tanah vulkanik Karo, 1.300 m di atas laut"
Card 2 — KEBUN       "Sayuran dan rempah dipetik tiap pagi sebelum fajar"
Card 3 — KANDANG     "Sapi FH kami menghasilkan susu segar setiap hari"
Card 4 — DAPUR       "Diolah tanpa pengawet, bumbu dari kebun sendiri"
Card 5 — MEJA        "Tiba di meja Anda — segar, hari yang sama"
```

---

### SECTION 04 · SIBAYAK MOMENT — Full-bleed Parallax Strip
**Concept:** Visual pause. Let the mountain speak. No cards, no borders. Pure photo.

**Photo needed:** ✅ USE `wINdownhoUSe_PIMS-1.JPG` again OR `1782545011508_image.png`
(the blue hour aerial with farmstead lit up in foreground, Sibayak in back)

**Layout:** 100vw × 90vh. Edge to edge. One quote bottom-left. Nothing else.

```js
gsap.to(".sibayak-img", {
  yPercent: 22,
  ease: "none",
  scrollTrigger: {
    trigger: ".sibayak-strip",
    start: "top bottom",
    end: "bottom top",
    scrub: 1.8
  }
});
```

**Overlaid text (bottom-left, Playfair italic):**
```
"Langit Berastagi tidak pernah sama dua kali."
— 3°11′ LS · 98°30′ BT · 1.300 m
```

---

### SECTION 05 · MENU HIGHLIGHTS — Asymmetric Photo Grid
**Concept:** Food photography showcase. Taste-skill grid — NOT 3 equal columns.

**Photos needed:**
```
A — large hero dish photo     (2×2 grid area — biggest, left side)
B — portrait format food      (1×2 tall — right side upper)
C — ingredient close-up       (1×1 — right side lower-left)
D — ambience / table setup    (1×1 — right side lower-right)
```
→ These are placeholders until food photography is ready.
→ Placeholder: use the farmstead building/garden photos you have now,
  then swap when food photos arrive. Mark with CSS class `img-placeholder`.

**CSS Grid layout:**
```css
.menu-grid {
  display: grid;
  grid-template-columns: 58% 21% 21%;
  grid-template-rows: 55vh 35vh;
  gap: 3px;
  grid-template-areas:
    "hero  tall  tall"
    "hero  sm-a  sm-b";
}
```

**Hover (Emil — scale inside overflow:hidden, no exceptions):**
```js
document.querySelectorAll(".menu-grid-item").forEach(item => {
  const img = item.querySelector("img");
  item.addEventListener("mouseenter", () => {
    gsap.to(img, { scale: 1.06, duration: 0.8, ease: "power2.out" });
  });
  item.addEventListener("mouseleave", () => {
    gsap.to(img, { scale: 1.0, duration: 0.7, ease: "power2.out" });
  });
});
// item must have overflow: hidden set in CSS — never skip this
```

**Section copy:**
```
[eyebrow]  MENU PILIHAN
[H2]       Rasa yang Datang
           dari Tanah Sendiri
[sub]      Disiapkan segar tiap hari. Menu berubah mengikuti musim.
[link]     Lihat Menu Lengkap →
```

---

### SECTION 06 · AMBIENCE — Building & Garden Gallery
**Concept:** Sell the atmosphere. The A-frame building at dusk. Garden paths.

**Photos needed — use what you have:**
```
A — 1782545234739_image.png   (daytime building facade)
B — 1782545243943_image.png   (garden/approach path)
C — 1782545265126_image.png   (building another angle)
D — 1782545367883_image.png   (aerial or wide establishing)
```

**Layout:** Horizontal staggered strip — photos at alternating heights, slightly overlapping.
NOT a uniform carousel. NOT equal heights.

```css
.ambience-strip {
  display: flex;
  align-items: flex-end;
  gap: 1.5rem;
  overflow: visible;
}
.ambience-strip .photo:nth-child(odd)  { margin-bottom: 4rem; height: 480px; }
.ambience-strip .photo:nth-child(even) { margin-bottom: 0;    height: 360px; }
```

**GSAP — stagger slide-up on scroll:**
```js
gsap.from(".ambience-strip .photo", {
  y: 60,
  opacity: 0,
  duration: 0.9,
  stagger: 0.15,
  ease: "power3.out",
  scrollTrigger: {
    trigger: ".ambience-strip",
    start: "top 75%"
  }
});
```

---

### SECTION 07 · MASCOT BREAK — Playful CTA
**Concept:** Warm, friendly pause in the editorial journey. Cow mascot bobs gently.
Maximum breathing room. One action only.

**Graphic needed:** ✅ USE cow mascot PNG (Images 9/10 — the waving cartoon cow)
Render as `<img>` tag, not inline SVG (easier to swap later).

```js
// Organic idle float — sine easing feels alive, linear feels robotic
gsap.to(".mascot-img", {
  y: -14, duration: 2.4, ease: "sine.inOut", yoyo: true, repeat: -1
});
// Cowbell subtle sway — delayed so it trails the body
gsap.to(".mascot-img", {
  rotation: 1.5, duration: 1.8, ease: "sine.inOut",
  yoyo: true, repeat: -1, delay: 0.4
});
```

**Copy:**
```
[H2]   Meja Anda Menunggu.
[sub]  Buka setiap hari. Reservasi dianjurkan untuk rombongan.
[CTA]  Reservasi Sekarang  →
[CTA2] Hubungi Kami (WhatsApp)
```

---

### SECTION 08 · LOCATION + HOURS
**Concept:** NOT a generic 4-column footer. Editorial band with coordinates as typography.

**Layout:**
```
┌──────────────────────────────────────────────────────────┐
│  3°11′ LS          [Google Map embed]     Jam Buka        │
│  98°30′ BT                                Senin – Minggu  │
│                                           10.00 – 21.00   │
│  Jl. Gundaling, Berastagi                                 │
│  Kab. Karo, Sumatera Utara                                │
└──────────────────────────────────────────────────────────┘
```

Coordinates styled at `clamp(2.5rem, 5vw, 4rem)` — Playfair Display, harvest gold.
This is the typographic signature of the footer. Make it unmissable.

---

## PHOTO & GRAPHIC ASSET MAP

Below is a complete list of what you need vs. what you already have.

### ✅ ALREADY HAVE (from uploads)
```
wINdownhoUSe_PIMS-1.JPG        → Hero bg + Sibayak strip
DJI_0067.JPG                   → Aerial farm (Journey Card 1 — Lahan)
1782545011508_image.png        → Aerial blue hour view
1782545234739_image.png        → Building daytime
1782545243943_image.png        → Garden/pathway
1782545265126_image.png        → Building angle
1782545367883_image.png        → Establishing/aerial
1782545445058_DJI_0026.JPG     → Aerial farm wide (Journey Card 3 — Kandang)
1782545482361_7.png            → Cow mascot waving (Mascot section)
1782545493288_7.png            → Cow mascot (backup)
1782545629304_resto_farm.PNG   → Restaurant building exterior (Section 02)
```

### ❌ STILL NEEDED — GUNDALING FARMSTEAD ONLY
```
FOOD PHOTOS (highest priority)
  · 3–5 plated dishes — for menu grid section
  · 1 hero food shot — the one image that sells the menu
  · Ingredient/produce close-up — vegetables, herbs, dairy
  · Kitchen or prep process photo

INTERIOR PHOTOS
  · Inside the A-frame dining hall — tables, ambience, lighting
  · Detail shots — table setting, glassware, natural light

GARDEN / LANDSCAPE
  · Garden pond close-up
  · Flower beds along driveway
  · Cypress tree row at dusk
```

### 📋 PHOTO BRIEF FOR YOUR PHOTOGRAPHER
```
Priority shoot list for Gundaling Farmstead:

1. MAGIC HOUR EXTERIOR (golden hour before sunset)
   — Building facade from the garden pond angle
   — Wide shot: A-frame + cypress trees + Sibayak in background

2. FOOD PHOTOGRAPHY (natural light, daytime)
   — Signature dishes plated on rustic wooden boards or ceramic
   — Overhead flat-lay of fresh ingredients from the garden
   — Steam rising from hot food — adds life and freshness

3. INTERIOR AMBIENCE
   — Empty dining hall, wide angle, showing the A-frame roof structure
   — Close detail: table setting, candle/lamp, window view to garden

4. STORY SHOTS
   — Chef harvesting from the garden (from behind, hands in soil)
   — Cow in open field with farmstead building in background
   — Milk being poured / processed (bridge to Gundaling Farm)
```

---

## IMPECCABLE ANTI-SLOP CHECKLIST

```
✗  ghost-card (border + wide shadow together) — pick one only
✗  border-radius > 12px on food/photo cards
✗  3 equal-width feature columns — use asymmetric grid always
✗  height: 100vh — use min-height: 100dvh
✗  ease-in on entering elements — always ease-out or power3.out
✗  bounce/elastic easing — wrong for a premium restaurant
✗  purple gradient anywhere — not in this palette
✗  "Elevate", "Seamless", "Farm-fresh Experience" clichés in copy
✗  horizontal scroll/marquee used more than once per page
✗  ScrollTrigger pin start: "top center" — must be "top top"
✗  transition: top, left, width, height — use transform + opacity only
✗  scale hover without overflow: hidden parent
✗  Lorem ipsum — all placeholder copy in Bahasa Indonesia
```

---

## BUILD ORDER FOR CLAUDE CODE

```
1.  layout.blade.php       — tokens, fonts, GSAP + Lenis CDN, boilerplate JS
2.  hero.blade.php         — full-viewport, parallax bg, staggered entrance
3.  philosophy.blade.php   — scrubbed word reveal, 2-col asymmetric split
4.  journey.blade.php      — 5-card sticky-stack (most complex — build carefully)
5.  sibayak.blade.php      — full-bleed parallax strip
6.  menu-grid.blade.php    — asymmetric CSS Grid, hover scale
7.  ambience.blade.php     — staggered photo strip
8.  mascot-cta.blade.php   — idle float animation, single CTA
9.  location.blade.php     — coordinate typography, map embed, hours
```

---

## FIRST COMMANDS IN CLAUDE CODE

```bash
# In project root:
npx impeccable install
npx skills@latest add emilkowalski/skills
npx skills add https://github.com/Leonxlnx/taste-skill
```

```
# Inside Claude Code session:
/impeccable init
```

Then paste this entire file and say:
> "Start with layout.blade.php. Set up CSS tokens, Playfair Display + DM Sans via
> Google Fonts, and the GSAP + Lenis boilerplate. Then build the hero section using
> wINdownhoUSe_PIMS-1.JPG as the background. Apply all skill rules — no defaults."

---

*Gundaling Farmstead · Farm to Table Restaurant*
*Separate from Gundaling Farm (dairy/cattle) — that site has its own prompt*
*Skills: emilkowalski · taste-skill · impeccable · Stack: Laravel + Tailwind + GSAP*

---

## SECTION 09 · GOOGLE REVIEWS — Dual-brand Auto-scroll Marquee

**Concept:** Three columns of review cards auto-scrolling continuously — col 1 up, col 2 down,
col 3 up (slower, delayed). Both brands appear in the same wall, colour-coded by brand.
Hovering the section pauses all columns. Pure CSS animation — no GSAP needed here.

**Colour coding:**
```
Farmstead cards  → background: rgba(44,26,14,0.75)  · badge: ember #C0724A
Farm cards       → background: rgba(14,32,16,0.75)  · badge: highland green #6AAA55
```

**HTML structure (Blade partial: `reviews.blade.php`):**
```html
<section class="reviews-section py-24 px-10 overflow-hidden" style="background: var(--fs-soil);">

  {{-- Header --}}
  <div class="reviews-header max-w-6xl mx-auto flex justify-between items-start gap-8 mb-14">
    <div>
      <p class="eyebrow text-[10px] font-medium uppercase tracking-[0.4em] text-ember mb-3">
        ★ Google Reviews
      </p>
      <h2 class="font-display text-5xl font-semibold text-cream leading-tight">
        Cerita dari<br>
        <em class="italic font-normal text-cream/50">tamu kami</em>
      </h2>
    </div>
    <div>
      <div class="flex gap-2 mb-4">
        <span class="brand-tag text-[9px] font-medium uppercase tracking-wide px-3 py-1 rounded-full"
              style="background: rgba(192,114,74,0.15); color: #C0724A; border: 1px solid rgba(192,114,74,0.3)">
          Gundaling Farmstead
        </span>
        <span class="brand-tag text-[9px] font-medium uppercase tracking-wide px-3 py-1 rounded-full"
              style="background: rgba(74,124,58,0.15); color: #6AAA55; border: 1px solid rgba(74,124,58,0.3)">
          Gundaling Farm
        </span>
      </div>
      <p class="text-sm text-cream/40 leading-relaxed max-w-xs">
        Pengunjung dari Medan, Jakarta, hingga mancanegara — berbagi pengalaman mereka di Berastagi.
      </p>
    </div>
  </div>

  {{-- Columns --}}
  <div class="reviews-columns max-w-6xl mx-auto grid grid-cols-3 gap-5 h-[640px] overflow-hidden"
       style="mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
              -webkit-mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);">

    {{-- Column 1 — scrolls UP --}}
    <div class="overflow-hidden">
      <div class="reviews-col-up flex flex-col gap-4">
        @foreach($farmsteadReviews->merge($farmReviews)->shuffle()->take(3) as $review)
          @include('partials.review-card', ['review' => $review])
        @endforeach
        {{-- Duplicate for seamless loop --}}
        @foreach($farmsteadReviews->merge($farmReviews)->shuffle()->take(3) as $review)
          @include('partials.review-card', ['review' => $review])
        @endforeach
      </div>
    </div>

    {{-- Column 2 — scrolls DOWN --}}
    <div class="overflow-hidden">
      <div class="reviews-col-down flex flex-col gap-4">
        ...
      </div>
    </div>

    {{-- Column 3 — scrolls UP (slower, delayed) --}}
    <div class="overflow-hidden">
      <div class="reviews-col-up flex flex-col gap-4" style="animation-duration: 44s; animation-delay: 3s;">
        ...
      </div>
    </div>

  </div>
</section>
```

**Review card partial (`partials/review-card.blade.php`):**
```html
<div class="review-card rounded-[14px] p-6 flex-shrink-0 transition-colors duration-300"
     style="background: {{ $review->brand === 'farmstead' ? 'rgba(44,26,14,0.75)' : 'rgba(14,32,16,0.75)' }};
            border: 1px solid rgba(245,237,216,0.07);
            backdrop-filter: blur(10px);">

  {{-- Brand badge --}}
  <span class="inline-flex text-[9px] font-medium uppercase tracking-wider px-2 py-1 rounded-full mb-4"
        style="{{ $review->brand === 'farmstead'
          ? 'background: rgba(192,114,74,0.15); color: #C0724A;'
          : 'background: rgba(74,124,58,0.15); color: #6AAA55;' }}">
    {{ $review->brand === 'farmstead' ? 'Gundaling Farmstead' : 'Gundaling Farm' }}
  </span>

  {{-- Stars --}}
  <div class="flex gap-0.5 mb-3 text-harvest text-[12px]">★★★★★</div>

  {{-- Quote icon (SVG) --}}
  <svg width="18" height="18" viewBox="0 0 24 24" fill="#C0724A" class="mb-3 opacity-60">...</svg>

  {{-- Review text --}}
  <p class="text-[13.5px] text-cream/68 leading-relaxed font-light italic mb-5">
    "{{ $review->text }}"
  </p>

  <hr style="border-color: rgba(245,237,216,0.06); margin-bottom: 14px;">

  {{-- Reviewer --}}
  <p class="text-[13px] font-medium text-cream">{{ $review->name }}</p>
  <p class="text-[11px] mt-0.5" style="color: {{ $review->brand === 'farmstead' ? '#C0724A' : '#6AAA55' }}">
    {{ $review->role }}
  </p>
  <p class="text-[11px] text-cream/25 mt-0.5">{{ $review->origin }}</p>

  {{-- Google logo --}}
  <div class="flex items-center gap-1 mt-3 text-[10px] text-cream/25">
    [Google G SVG] Google Review
  </div>
</div>
```

**CSS animations (in app.css or layout.blade.php `<style>`):**
```css
.reviews-col-up {
  animation: reviewScrollUp 32s linear infinite;
}
.reviews-col-down {
  animation: reviewScrollDown 38s linear infinite;
}

@keyframes reviewScrollUp {
  0%   { transform: translateY(0); }
  100% { transform: translateY(-50%); }
}

@keyframes reviewScrollDown {
  0%   { transform: translateY(-50%); }
  100% { transform: translateY(0); }
}

/* Pause on hover — whole section */
.reviews-section:hover .reviews-col-up,
.reviews-section:hover .reviews-col-down {
  animation-play-state: paused;
}

/* Reduced motion — freeze all */
@media (prefers-reduced-motion: reduce) {
  .reviews-col-up, .reviews-col-down {
    animation: none;
  }
}
```

**Laravel data source — two options:**

Option A — Static array in controller (start here, no DB needed):
```php
// In HomeController.php
$farmsteadReviews = collect([
    ['brand' => 'farmstead', 'name' => 'Budi & Rina Santoso', 'role' => 'Tamu reservasi',
     'origin' => 'Medan', 'text' => 'Pemandangan Sibayak dari meja makan sungguh tak terlupakan...'],
    // ... more reviews
]);

$farmReviews = collect([
    ['brand' => 'farm', 'name' => 'Keluarga Harahap', 'role' => 'Wisata keluarga',
     'origin' => 'Pematang Siantar', 'text' => 'Anak-anak bisa menyentuh sapi langsung...'],
]);
```

Option B — DB table (when real Google reviews are collected):
```php
// reviews table: id, brand (enum: farmstead|farm), name, role, origin, text, is_active
$farmsteadReviews = Review::where('brand', 'farmstead')->where('is_active', true)->get();
$farmReviews      = Review::where('brand', 'farm')->where('is_active', true)->get();
```

**Column distribution — recommended:**
```
Col 1: 2 Farmstead + 1 Farm  (warm tone dominant)
Col 2: 1 Farmstead + 2 Farm  (cool tone dominant)
Col 3: 2 Farmstead + 1 Farm  (offset from col 1)
```
Each column must duplicate its own cards (append same set below) so the
loop is seamless — translateY(-50%) lands back exactly where it started.

**Impeccable rules for this section:**
```
✗  Do NOT add border-radius > 14px on review cards
✗  Do NOT use star emojis in the DOM (use ★ text character)
✗  Do NOT use box-shadow on cards — border only
✗  Do NOT place hover effects on individual cards (section-level pause is enough)
✗  Do NOT add a "See all reviews" link that goes to a dead page
   — only add this link when Google Business Profile is live and verified
```

**Google Business Profile requirement:**
The Google G badge on each card should eventually link to:
`https://g.page/r/9904571155086556270/review` for
Gundaling Farmstead and `https://g.page/r/2252842551209686390/review` for Gundaling Farm  are verified on Google Maps.
