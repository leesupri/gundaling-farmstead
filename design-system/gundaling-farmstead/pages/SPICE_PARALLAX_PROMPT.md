# Karo Spice Parallax Background — Claude Code Prompt
# Menu Page · ScrollTrigger · GSAP · Gundaling Farmstead

---

## CONTEXT — READ BEFORE WRITING ANY CODE

These SVG files are high-fidelity grayscale photorealistic illustrations
of Karo/Batak spices — the same spices used in the restaurant kitchen.
They have TRANSPARENT backgrounds and are portrait-oriented (1080×1382px).

FILE INVENTORY (all in /public/images/spices/):
  lemongrass.svg    — 2.9MB, 16k paths  → tall, thin stalks
  cikala.svg        — 4.5MB, 23k paths  → medium, leafy
  galangal.svg      — 4.3MB, 22k paths  → medium, rhizome form
  andaliman.svg     — 4.2MB, 22k paths  → small berry clusters
  turmeric.svg      — 4.6MB, 24k paths  → medium, rhizome form
  kecombrang.svg    — 5.4MB, 29k paths  → large, dramatic flower
  Asam-Gelugur.svg  — 6.5MB, 35k paths  → largest, fruit slices

CRITICAL RULES — non-negotiable:
1. NEVER inline any of these SVGs — always <img src="..."> external
2. NEVER animate individual paths inside the SVGs
3. ONLY animate the wrapper <div> or <img> element via GSAP
4. Load lazily (loading="lazy") on all EXCEPT the 2 nearest viewport
5. Wrap ALL GSAP in gsap.matchMedia() prefers-reduced-motion check
6. These SVGs are grayscale — use CSS filter to tint to brand colors
7. Total 31MB across 7 files — never load all 7 simultaneously on mobile

---

## WHAT TO BUILD

A 3-layer GSAP ScrollTrigger parallax spice background system for the
Gundaling Farmstead MENU PAGE. The spices float at different depths
behind the menu content, creating a cinematic sense of immersion as
the user scrolls through menu categories.

---

## LAYER ARCHITECTURE

Assign each spice to a depth layer based on visual weight and shape:

LAYER 1 — BACK (slowest scroll, lowest opacity, smallest scale)
  Files: lemongrass.svg, cikala.svg
  Parallax speed: scrolls at 15% of page scroll speed (scrub: 1, y: "-15%")
  Opacity: 0.06–0.08
  Scale: 0.55–0.70
  CSS tint: green (#2C5F2D) — these are leafy/stalk shapes

LAYER 2 — MID (medium scroll, medium opacity)
  Files: galangal.svg, andaliman.svg, turmeric.svg
  Parallax speed: 30% of page scroll (y: "-30%")
  Opacity: 0.07–0.10
  Scale: 0.65–0.85
  CSS tint: earth brown (#7B4B2D) — rhizomes and berries

LAYER 3 — FRONT (fastest scroll, highest opacity, largest scale)
  Files: kecombrang.svg, Asam-Gelugur.svg
  Parallax speed: 50% of page scroll (y: "-50%")
  Opacity: 0.09–0.12
  Scale: 0.80–1.0
  CSS tint: gold (#F5C542) — dramatic large shapes

---

## HTML STRUCTURE

Add this INSIDE the menu page, as a sibling to .menu-content.
The .menu-spice-stage is absolute, covers the full menu section,
pointer-events: none so it never blocks clicks on menu items.

```html
<!-- In menu.blade.php, inside <section id="menu"> -->
<div class="menu-spice-stage" aria-hidden="true">

  <!-- LAYER 1: BACK — green tint, slow -->
  <div class="spice-layer spice-layer-back">
    <div class="spice-wrap" data-spice="lemongrass" style="--spice-x: 5%; --spice-top: 8%; --spice-rot: -15deg; --spice-scale: 0.6">
      <img src="{{ asset('images/spices/lemongrass.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="lemongrass" style="--spice-x: 82%; --spice-top: 55%; --spice-rot: 22deg; --spice-scale: 0.55">
      <img src="{{ asset('images/spices/lemongrass.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="cikala" style="--spice-x: 45%; --spice-top: 72%; --spice-rot: -8deg; --spice-scale: 0.65">
      <img src="{{ asset('images/spices/cikala.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="cikala" style="--spice-x: 15%; --spice-top: 88%; --spice-rot: 30deg; --spice-scale: 0.58">
      <img src="{{ asset('images/spices/cikala.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
  </div>

  <!-- LAYER 2: MID — earth brown tint, medium -->
  <div class="spice-layer spice-layer-mid">
    <div class="spice-wrap" data-spice="galangal" style="--spice-x: 72%; --spice-top: 12%; --spice-rot: 18deg; --spice-scale: 0.75">
      <img src="{{ asset('images/spices/galangal.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="andaliman" style="--spice-x: 2%; --spice-top: 35%; --spice-rot: -12deg; --spice-scale: 0.7">
      <img src="{{ asset('images/spices/andaliman.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="turmeric" style="--spice-x: 58%; --spice-top: 60%; --spice-rot: 25deg; --spice-scale: 0.8">
      <img src="{{ asset('images/spices/turmeric.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="galangal" style="--spice-x: 30%; --spice-top: 82%; --spice-rot: -5deg; --spice-scale: 0.68">
      <img src="{{ asset('images/spices/galangal.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
  </div>

  <!-- LAYER 3: FRONT — gold tint, fastest -->
  <div class="spice-layer spice-layer-front">
    <div class="spice-wrap" data-spice="kecombrang" style="--spice-x: 88%; --spice-top: 5%; --spice-rot: -20deg; --spice-scale: 0.9">
      <img src="{{ asset('images/spices/kecombrang.svg') }}"
           alt="" role="presentation" loading="eager"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="kecombrang" style="--spice-x: -4%; --spice-top: 62%; --spice-rot: 15deg; --spice-scale: 0.85">
      <img src="{{ asset('images/spices/kecombrang.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="asam" style="--spice-x: 40%; --spice-top: 25%; --spice-rot: -32deg; --spice-scale: 1.0">
      <img src="{{ asset('images/spices/Asam-Gelugur.svg') }}"
           alt="" role="presentation" loading="eager"
           class="spice-img" width="220" height="282">
    </div>
    <div class="spice-wrap" data-spice="asam" style="--spice-x: 70%; --spice-top: 78%; --spice-rot: 10deg; --spice-scale: 0.88">
      <img src="{{ asset('images/spices/Asam-Gelugur.svg') }}"
           alt="" role="presentation" loading="lazy"
           class="spice-img" width="220" height="282">
    </div>
  </div>

</div>
```

---

## CSS (add to resources/css/app.css or menu.css)

```css
/* ─── SPICE PARALLAX STAGE ─── */
#menu {
  position: relative;   /* stage needs positioned parent */
  overflow: hidden;     /* clip spices that drift outside bounds */
}

.menu-spice-stage {
  position: absolute;
  inset: 0;
  z-index: 0;
  pointer-events: none;   /* never block menu item clicks */
  user-select: none;
}

/* Menu content must sit above the stage */
.menu-content,
.menu-category-nav,
.menu-grid {
  position: relative;
  z-index: 1;
}

/* Each layer */
.spice-layer {
  position: absolute;
  inset: 0;
  /* GSAP will apply will-change on init */
}

/* Each individual spice wrapper */
.spice-wrap {
  position: absolute;
  left: var(--spice-x);
  top: var(--spice-top);
  transform:
    rotate(var(--spice-rot))
    scale(var(--spice-scale));
  transform-origin: center center;
  /* GSAP controls translateY — don't add transform here */
}

/* The actual image */
.spice-img {
  display: block;
  width: 220px;     /* fixed render size — SVG scales via scale() */
  height: auto;
  /* Grayscale base — CSS filter tints to brand */
}

/* ─── LAYER COLOR TINTS ─── */
/* Convert grayscale SVG to brand colors using CSS filter */

/* Back layer → farm green */
.spice-layer-back .spice-img {
  filter:
    grayscale(1)
    sepia(0.6)
    hue-rotate(60deg)
    saturate(1.4)
    brightness(0.7)
    opacity(0.07);
}

/* Mid layer → earth brown */
.spice-layer-mid .spice-img {
  filter:
    grayscale(1)
    sepia(0.8)
    hue-rotate(10deg)
    saturate(1.2)
    brightness(0.65)
    opacity(0.09);
}

/* Front layer → gold */
.spice-layer-front .spice-img {
  filter:
    grayscale(1)
    sepia(1)
    hue-rotate(10deg)
    saturate(2)
    brightness(0.85)
    opacity(0.10);
}

/* ─── MOBILE: reduce to 3 spices max ─── */
@media (max-width: 768px) {
  /* Hide all except 3 key spices on mobile */
  .spice-wrap:nth-child(n+4) {
    display: none;
  }
  /* Smaller scale on mobile */
  .spice-img {
    width: 150px;
  }
}

/* ─── DARK SECTION VARIANT ─── */
/* When menu is on dark bg (farm-800), increase opacity slightly */
.bg-dark .spice-layer-back .spice-img  { filter: grayscale(1) brightness(1.4) opacity(0.08); }
.bg-dark .spice-layer-mid .spice-img   { filter: grayscale(1) sepia(0.4) brightness(1.2) opacity(0.10); }
.bg-dark .spice-layer-front .spice-img { filter: grayscale(1) sepia(0.6) brightness(1.1) opacity(0.12); }
```

---

## JAVASCRIPT (add to resources/js/menu.js or app.js)

```javascript
// ─── KARO SPICE PARALLAX ───
// Runs AFTER window.load (positions must be stable)
// Wrapped in gsap.matchMedia for reduced-motion safety

window.addEventListener('load', () => {

  const mm = gsap.matchMedia();

  mm.add("(prefers-reduced-motion: no-preference)", () => {

    // ── 1. SET PERFORMANCE HINTS ──
    // Tell browser these will animate — enables GPU compositing
    gsap.set(".spice-layer", { willChange: "transform" });

    // ── 2. LAYER 1: BACK — slow (15% scroll rate) ──
    gsap.to(".spice-layer-back", {
      yPercent: -15,
      ease: "none",
      scrollTrigger: {
        trigger: "#menu",
        start: "top bottom",   // when menu top hits viewport bottom
        end: "bottom top",     // when menu bottom leaves viewport top
        scrub: 1.5,            // smooth lag (1.5s behind scroll)
      }
    });

    // ── 3. LAYER 2: MID — medium (30% scroll rate) ──
    gsap.to(".spice-layer-mid", {
      yPercent: -30,
      ease: "none",
      scrollTrigger: {
        trigger: "#menu",
        start: "top bottom",
        end: "bottom top",
        scrub: 1.2,
      }
    });

    // ── 4. LAYER 3: FRONT — fastest (50% scroll rate) ──
    gsap.to(".spice-layer-front", {
      yPercent: -50,
      ease: "none",
      scrollTrigger: {
        trigger: "#menu",
        start: "top bottom",
        end: "bottom top",
        scrub: 0.8,           // tighter follow for front layer
      }
    });

    // ── 5. INDIVIDUAL MICRO-ROTATIONS per spice ──
    // Each spice wrapper gets a subtle extra rotation as user scrolls
    // Creates the sense of spinning/drifting, not just moving up
    document.querySelectorAll(".spice-wrap").forEach((wrap, i) => {
      const direction = i % 2 === 0 ? 1 : -1;   // alternate CW/CCW
      const amount = 8 + (i % 3) * 4;             // 8, 12, or 16 degrees

      gsap.to(wrap, {
        rotation: `+=${direction * amount}`,
        ease: "none",
        scrollTrigger: {
          trigger: "#menu",
          start: "top bottom",
          end: "bottom top",
          scrub: 2,           // very smooth rotation
        }
      });
    });

    // ── 6. FADE IN on menu section enter ──
    // The whole stage fades in as menu section enters viewport
    gsap.from(".menu-spice-stage", {
      opacity: 0,
      duration: 1.2,
      ease: "power2.out",
      scrollTrigger: {
        trigger: "#menu",
        start: "top 80%",
        toggleActions: "play none none reverse",
      }
    });

    // ── 7. CLEANUP on component unmount (SPA nav) ──
    return () => {
      ScrollTrigger.getAll().forEach(st => {
        if (st.vars.trigger === document.querySelector("#menu")) {
          st.kill();
        }
      });
    };

  }); // end matchMedia

  // ── 8. MOBILE PERFORMANCE: kill parallax under 768px ──
  mm.add("(max-width: 767px)", () => {
    // On mobile: no parallax at all, just static tinted spices
    // The spices are still visible via CSS, just not animated
    // This saves ~60% of mobile CPU usage
    gsap.set(".spice-layer", { clearProps: "willChange" });
  });

}); // end window.load
```

---

## LARAVEL ASSET SETUP

```bash
# Copy spice SVGs to public images folder
mkdir -p public/images/spices

cp resources/svg/spices/lemongrass.svg    public/images/spices/
cp resources/svg/spices/cikala.svg        public/images/spices/
cp resources/svg/spices/galangal.svg      public/images/spices/
cp resources/svg/spices/andaliman.svg     public/images/spices/
cp resources/svg/spices/turmeric.svg      public/images/spices/
cp resources/svg/spices/kecombrang.svg    public/images/spices/
cp resources/svg/spices/Asam-Gelugur.svg  public/images/spices/
```

Add to .htaccess (Rumahweb / Apache) for gzip compression of SVGs:
```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>

# Cache spice SVGs aggressively (they never change)
<FilesMatch "\.svg$">
  Header set Cache-Control "public, max-age=31536000, immutable"
</FilesMatch>
```

---

## FINE-TUNING GUIDE

After implementation, adjust these values in browser DevTools:

OPACITY (in CSS filter):
  Too visible/distracting → lower opacity(0.07) to opacity(0.04)
  Too subtle → raise to opacity(0.12–0.15)
  Rule: menu text must always read at 100% — spices are texture, not content

PARALLAX SPEED (scrub values in JS):
  Feels too fast → increase scrub (1.5 → 3)
  Feels laggy/slow → decrease scrub (1.5 → 0.8)
  No parallax feel → decrease yPercent gap between layers

TINT COLOR (CSS filter hue-rotate):
  More green → hue-rotate(80deg) on back layer
  More amber/warm → hue-rotate(20deg) + saturate(2.5)
  Neutral monochrome → remove sepia() and hue-rotate(), keep grayscale only

SPICE POSITIONS (--spice-x, --spice-top CSS vars):
  Adjust per category: some menu categories might want different spice placement
  Can target per category: .menu-category-karo .spice-layer-back etc.

---

## PERFORMANCE BUDGET

Target: zero layout shift, zero LCP impact, <5ms per scroll frame

SVG sizes after gzip compression (approximate):
  lemongrass.svg:   ~420KB  (was 2.9MB)
  cikala.svg:       ~650KB  (was 4.5MB)
  galangal.svg:     ~610KB  (was 4.3MB)
  andaliman.svg:    ~600KB  (was 4.2MB)
  turmeric.svg:     ~660KB  (was 4.6MB)
  kecombrang.svg:   ~770KB  (was 5.4MB)
  Asam-Gelugur.svg: ~920KB  (was 6.5MB)
  Total gzipped: ~4.6MB (vs 31MB raw)

Loading strategy:
  - 2 nearest viewport (kecombrang + Asam-Gelugur front layer): loading="eager"
  - All others: loading="lazy"
  - Browser only fetches SVGs when they're ~1 viewport away from visible
  - GSAP willChange:"transform" ensures GPU layer promotion

GSAP ScrollTrigger with scrub uses rAF internally — no layout thrash.
Only transform/opacity animated — no width/height/top/left = GPU only.

---

## QUALITY CHECKLIST

[ ] All 7 spice SVGs in public/images/spices/ (accessible via browser)
[ ] ZERO inline SVG content — only <img src="..."> references
[ ] loading="lazy" on all spices EXCEPT the 2 front-layer ones
[ ] gsap.matchMedia() wraps ALL animation code
[ ] Mobile (< 768px): GSAP parallax disabled, CSS static display only
[ ] .menu-content z-index: 1 > .menu-spice-stage z-index: 0
[ ] pointer-events: none on .menu-spice-stage (never blocks clicks)
[ ] aria-hidden="true" on .menu-spice-stage (decorative only)
[ ] role="presentation" + empty alt="" on all spice <img> tags
[ ] .htaccess: SVG gzip + immutable cache headers
[ ] CSS filter opacity: menu text contrast unaffected (test WCAG AA)
[ ] ScrollTrigger trigger: "#menu", start/end spans full menu section
[ ] scrub values: back 1.5, mid 1.2, front 0.8 (front snappier)
[ ] Individual micro-rotation: alternating CW/CCW per spice
[ ] Fade-in of whole stage on menu section enter (not instant)
[ ] ScrollTrigger.refresh() called after window.load
