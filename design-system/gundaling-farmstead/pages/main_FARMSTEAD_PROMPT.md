# GUNDALING FARMSTEAD — Claude Code Build Prompt
# gundalingfarmstead.com · Laravel 11 · Filament v3 · Tailwind CSS · Alpine.js · GSAP · i18n



## STEP 2 — MAIN BUILD PROMPT (paste this entire block into Claude Code)

```
Before writing any code, read all installed SKILL.md files.
Apply: emil-design-eng (animation polish) + design-taste-frontend (no generic slop)
       + UI UX Pro Max ORGANIC BIOPHILIC #24 + PARALLAX STORYTELLING #31

Taste-skill brief for this project:
  industry: farm-to-table restaurant, agritourism, artisan dairy
  vibe: warm, organic, prestigious, highland heritage
  audience: Indonesian families, domestic tourists, food enthusiasts
  motion depth: HIGH — immersive scroll scenes, scene-by-scene reveals
  layout family: editorial with cinematic photo-led sections
  variance: HIGH — never let two adjacent sections look the same

Build the complete Gundaling Farmstead restaurant website.

====================================================================
BRAND
====================================================================
Name:        Gundaling Farmstead Restaurant
Domain:      gundalingfarmstead.com
Hub:         pimsgundaling.com (parent links here)
Sister:      gundalingfarm.com (cross-linked throughout)
Company:     PT. Putra Indo Mandiri Sejahtera
Address:     Jl. Jamin Ginting, Desa Jaranguda, Simpang Pelawi,
             Kabupaten Karo, Berastagi 22158, North Sumatra, Indonesia
Phone:       +62 812-3456-7890
Email:       info@gundalingfarmstead.com
WA:          https://wa.me/6282162599980
Instagram:   @gundalingfarmstead
Coords:      lat 3.211194, lng 98.508194
Hours:       Restaurant 10:00–20:00 (last order 19:00) daily
Primary:     English · Secondary: Indonesian (/id/ routes)

COLOR SYSTEM (Tailwind config — extend these):
  farm-950: #0e1810   farm-900: #162318   farm-800: #1E2F1C
  farm-700: #1E4B1F   farm-600: #2C5F2D   farm-500: #3d7a3e
  farm-400: #4a9c56   farm-300: #82be89
  earth-600: #7B4B2D  earth-300: #E6D5B8  earth-200: #F9F6EF
  gold: #F5C542       amber: #E8943A      fire: #D4520E

FONTS:
  display: "Playfair Display" (headings, pull quotes, hero titles)
  body:    "Nunito" (all body, labels, prices, UI)

====================================================================
PHOTOGRAPHY — ASSIGN EACH PHOTO TO ITS PAGE/SECTION
====================================================================
Supriadi_golden_hour-_17-07-22-5.jpg
  → FARMSTEAD hero background (restaurant exterior at golden dusk,
    red roof building glowing, pond reflection, lush gardens)
  → Use as: HOME hero bg + ABOUT page header bg
  → Mood: warm, premium, aspirational

Supriadi_golden_hour-_19-06-22-1__1_.jpg
  → HOME "The Experience" full-width section background
  → Fisheye night shot: restaurant surrounded by light trails,
    Mt. Sinabung silhouette in background
  → Use with dark overlay (black/55) for dramatic effect

DJI_0016-1.jpg
  → HOME story section + ABOUT "The Place" section
  → Drone daytime: red roof, koi pond, vegetable garden clearly
    visible, valley stretching to mountains
  → Aspect: landscape, use object-position: center 60%

Resto.jpg
  → PROMO page hero + CONTACT page header
  → Stone entrance path, signage "Gundaling Restaurant Farmstead
    Est. 2005", leading toward restaurant building
  → Perfect for "Find Us" / arrival experience section

resto_farm.PNG
  → ABOUT page timeline section background (faded, 20% opacity)
  → Panoramic: winding cobblestone driveway, flower borders,
    full property vista with mountains behind
  → Use as wide landscape strip behind timeline component

supriadi-lee-pims-9_orig.jpg (farm with erupting Sinabung)
  → HOME "From the Farm" bridge section linking to gundalingfarm.com
  → Caption on image: "Our farm, just minutes away →"

7_-_Copy.png (cow mascot, waving, no apron)
  → Used ONLY for: 404 error page, 419 error page
  → cow_mascot_question.png — rename this file to that
  → Not used on the main restaurant site (mascot is Farm brand)

MASCOT NOTES FOR FARMSTEAD:
  The restaurant site uses the mascot SPARINGLY — only on error pages
  and the "Visit the Farm" cross-link CTA section.
  The restaurant brand is more refined/grown-up than the farm brand.
  Use the FARMSTEAD LOGO (logo.png) as the primary visual identity here.

====================================================================
GSAP ANIMATION SYSTEM
====================================================================
Import GSAP in resources/js/app.js:
  import { gsap } from "gsap";
  import { ScrollTrigger } from "gsap/ScrollTrigger";
  import { SplitText } from "gsap/SplitText";
  gsap.registerPlugin(ScrollTrigger, SplitText);

GSAP RULES (from emil-design-eng skill):
  - Duration: micro-interactions 150–250ms, section reveals 600–900ms
  - Easing: NEVER use "ease-in" for entering elements
    Use: "power2.out" (enters), "power3.inOut" (transitions),
         "back.out(1.7)" (spring feel), "expo.out" (dramatic reveals)
  - Stagger: 0.08–0.12s between siblings (never more)
  - Always animate transform + opacity only (GPU-accelerated)
  - Wrap all ScrollTrigger in: if(!mm.matches) for reduced-motion

CORE ANIMATION PATTERNS:

// Hero title split-text reveal (SplitText)
const split = new SplitText(".hero-title", { type: "lines,words" });
gsap.from(split.words, {
  y: 80, opacity: 0, duration: 0.8, stagger: 0.06,
  ease: "power3.out", delay: 0.3
});

// Scene reveal on scroll (ScrollTrigger)
gsap.from(".scene-img", {
  scrollTrigger: { trigger: ".scene", start: "top 75%", toggleActions: "play none none reverse" },
  x: -80, opacity: 0, duration: 0.9, ease: "power2.out"
});
gsap.from(".scene-text", {
  scrollTrigger: { trigger: ".scene", start: "top 70%" },
  x: 80, opacity: 0, duration: 0.9, delay: 0.15, ease: "power2.out"
});

// Parallax hero background
gsap.to(".hero-bg", {
  scrollTrigger: { trigger: "#hero", start: "top top", end: "bottom top", scrub: true },
  y: "25%", ease: "none"
});

// Stagger card entrance
gsap.from(".menu-card", {
  scrollTrigger: { trigger: ".menu-grid", start: "top 80%" },
  y: 40, opacity: 0, duration: 0.6, stagger: 0.1, ease: "power2.out"
});

// Timeline line draw (about page)
gsap.from(".timeline-progress", {
  scrollTrigger: { trigger: ".timeline", start: "top 60%", scrub: 1 },
  scaleX: 0, transformOrigin: "left center", ease: "none"
});

// Number counter (stats)
gsap.from(".stat-number", {
  scrollTrigger: { trigger: ".stats-row", start: "top 80%" },
  textContent: 0, duration: 1.5, ease: "power1.out",
  snap: { textContent: 1 }, stagger: 0.2
});

====================================================================
DATABASE SCHEMA
====================================================================

php artisan make:migration create_menu_categories_table
php artisan make:migration create_menu_items_table
php artisan make:migration create_promos_table
php artisan make:migration create_reservations_table

Schema:

menu_categories: id, name, name_id, slug, sort_order, is_active,
  icon(nullable), image(nullable), timestamps

menu_items: id, category_id(FK), name, name_id, description, description_id,
  price(decimal 10,2), image(nullable), is_available(bool,true),
  is_sold_out(bool,false), is_featured(bool,false), badge(nullable),
  sort_order, timestamps

promos: id, title, title_id, description, description_id,
  image(nullable), tag, tag_id, valid_until(date,nullable),
  is_active(bool), sort_order, timestamps

reservations: id, name, email, phone, date, time, guests(int),
  occasion(nullable), notes(text,nullable), group_name(nullable),
  status(enum:pending,confirmed,cancelled,completed,beo_uploaded → default:pending),
  wa_sent(bool,false), beo_file(nullable), timestamps

Seeders: create 6 menu categories + 20 sample items + 3 promos

====================================================================
FILAMENT ADMIN (/admin) — AUTH REQUIRED
====================================================================

Resources to build:

1. MenuCategoryResource
   Table: name, slug, sort_order, is_active toggle, item count
   Form: name(EN), name_id(ID), slug(auto-gen), icon, image upload,
         sort_order(number), is_active(toggle)
   Features: drag-to-reorder rows

2. MenuItemResource (most-used resource)
   Table: category filter, name, price formatted, is_available toggle,
          is_sold_out toggle (LARGE prominent toggle — most clicked),
          is_featured toggle, image thumb
   Form: category(select), name+name_id, description+description_id,
         price, image upload, is_available, is_sold_out, is_featured,
         badge(select: New/Signature/Spicy/Chef's Pick/Seasonal), sort_order
   Bulk actions: [Mark All Sold Out] [Mark All Available] [Toggle Featured]
   Filter: by category, by sold_out status, by available status

3. PromoResource
   Table: title, tag, valid_until, is_active toggle, image thumb
   Form: title+title_id, description+description_id, tag+tag_id,
         image upload, valid_until(datepicker), is_active, sort_order

4. ReservationResource
   Table: name, date, time, guests, status(colored badge),
          wa_sent(icon), beo_uploaded(icon)
   Filter: date range, status, group/event flag
   Actions:
     - View: full detail modal
     - Change Status: inline select
     - WA Confirm: opens pre-filled wa.me link
       "Hi [name], your reservation at Gundaling Farmstead on [date]
        at [time] for [guests] guests is confirmed. See you soon!"
     - Upload BEO: PDF only, max 10MB
       → stored: storage/app/private/beos/reservation_{id}_{date}.pdf
       → download route: GET /secure/beo/{reservation}
       → NEVER on public disk, NEVER publicly accessible
       → auth middleware: ['auth', 'verified']
     - Export CSV: date range picker → download
   
Dashboard widgets:
  - Widget 1: "Today's Reservations" count + list of today's bookings
  - Widget 2: "Currently Sold Out" items with quick un-mark button
  - Widget 3: "Active Promos" count + next expiring promo date
  - Widget 4: "Upcoming 7 Days" reservation count bar chart

====================================================================
ROUTES (web.php)
====================================================================

// English (default)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reservations', [ReservationController::class, 'create'])->name('reservations');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/confirmation/{reservation}', [ReservationController::class, 'confirmation'])->name('reservations.confirmation');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Indonesian
Route::prefix('id')->name('id.')->group(function () {
  Route::get('/', [PageController::class, 'home'])->name('home');
  Route::get('/menu', [MenuController::class, 'index'])->name('menu');
  Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservations');
  Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservations.store');
  Route::get('/promo', [PromoController::class, 'index'])->name('promo');
  Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
  Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
});

// Secure BEO download — admin only
Route::middleware(['auth', 'verified'])
  ->get('/secure/beo/{reservation}', [ReservationController::class, 'downloadBeo'])
  ->name('beo.download');

// Locale middleware: reads /id/ prefix → App::setLocale('id'), else 'en'

====================================================================
i18n
====================================================================
lang/en/nav.php, lang/en/home.php, lang/en/menu.php,
lang/en/reservations.php, lang/en/common.php, lang/en/errors.php
(duplicate all under lang/id/)

Language switcher in nav Blade:
@php $base = str_replace('id.', '', Route::currentRouteName()); @endphp
<a href="{{ route($base) }}">EN</a>
<a href="{{ route('id.'.$base) }}">ID</a>

hreflang in layout <head>:
<link rel="alternate" hreflang="en" href="https://gundalingfarmstead.com/{{ ltrim(request()->path(), 'id/') }}"/>
<link rel="alternate" hreflang="id" href="https://gundalingfarmstead.com/id/{{ ltrim(request()->path(), 'id/') }}"/>

Menu items: $item->localName() helper returns name_id when locale=id

====================================================================
PAGE 1: HOME (/) — IMMERSIVE GSAP SCROLL
====================================================================

Structure this page as a vertical cinematic narrative.
Each section is a "scene" in the farm-to-table story.
GSAP ScrollTrigger drives ALL section animations.

--- SCENE 0: FULL SCREEN HERO ---
Background: Supriadi_golden_hour-_17-07-22-5.jpg
  cover, center 35%, fixed attachment on desktop
  parallax: gsap.to(".hero-bg", {y:"25%", scrollTrigger:{scrub:true}})

Overlay: linear-gradient(135deg, rgba(14,24,16,0.75) 0%, rgba(14,24,16,0.45) 60%, transparent 100%)

Left content (max-w-2xl):
  Eyebrow: "Est. 2005 · Berastagi, North Sumatra"
    → animated pulse dot (CSS) + GSAP fadeIn delay 0.2s
  H1 (Playfair Display, clamp 3rem→5.5rem, white):
    "Where the Farm<br>Meets Your Fork"
    → SplitText word reveal, stagger 0.06s, power3.out
  Subtext (Nunito lg, white/75):
    "Every ingredient on this table was grown just steps away.
     From highland soil to open kitchen — this is real farm to table."
    → GSAP fadeUp delay 0.6s
  CTAs (stagger 0.1s):
    [View Menu →] (farm-600 bg, Nunito bold)
    [Reserve a Table] (white outline)
  Stats strip (bottom-left): 20+ Years · Open Kitchen · Est. 2005
    → number counter animation on scroll

Right: EMPTY on hero (let the photo breathe — don't put mascot here)
  The restaurant is the hero, not the mascot.

Bottom: animated chevron bounce + "Scroll to discover" text

--- SCENE 1: "IT STARTS ON THE FARM" ---
Two-column (lg:grid-cols-2), dark green bg (farm-800)
Left: supriadi-lee-pims-9_orig.jpg (farm + Sinabung erupting)
  border-radius: 1.5rem, shadow-2xl
  GSAP: x:-80→0, opacity:0→1, power2.out on scroll
Right:
  Label: "The Farm · Step 1 of 5" (gold, small caps)
  H2 (Playfair, white): "It starts on the farm."
  Body (white/65): 200+ Holstein cows grazing at 1,400m elevation.
    Volcanic soil. Cool highland air. The foundation of every dish.
  CTA link: "Visit Gundaling Farm →" → gundalingfarm.com (new tab, amber color)
  GSAP: x:80→0, opacity:0→1, delay:0.15, power2.out

--- SCENE 2: "THE DAIRY JOURNEY" ---
Reverse layout, cream bg (earth-200)
Right: Large decorative text "Fresh." behind image (Playfair, 20rem, opacity 5%)
Left: milk bottle illustration (CSS art or simple SVG, no external images)
Right column text:
  Label: "The Dairy · Step 2 of 5"
  H2: "Fresh milk, every morning."
  Body: Pasteurised on-site. Turned into five artisan cheeses,
    creamy gelato, and probiotic yogurt — all before noon.
  Product pills: [Fresh Milk] [Artisan Cheese] [Yogurt Drink] [Gelato]
    → GSAP stagger-reveal, each pill y:20→0, opacity:0→1

--- SCENE 3: "THE CHEESE VAULT" ---
Full width, dark bg (farm-950)
Background: promo-cheese.jpg at 15% opacity (behind content)
Center content (max-w-4xl, mx-auto):
  H2 (Playfair, white, 3rem): "Five cheeses.<br>All made here."
  5 cards in horizontal scroll (overflow-x-auto on mobile, grid on desktop):
    Mozzarella · Curd · Gundaling Cheese · Sinabung Tomme · Andaliman Tomme
    Each card: dark bg, cheese name (Playfair), aging note, flavor descriptor
    GSAP: stagger from y:50→0 + opacity:0→1, 0.12s stagger

--- SCENE 4: "THE OPEN KITCHEN" ---
Photo-led full width section
Background: Supriadi_golden_hour-_19-06-22-1__1_.jpg (the fisheye night shot)
  height: 80vh, object-fit:cover, object-position: center 40%
  Dark gradient from right side (transparent → farm-950/90)
Right-aligned text overlay:
  Label: "The Kitchen · Step 4 of 5"
  H2 (white Playfair, 2.8rem): "Our kitchen is open.<br>Always."
  Body: Watch every dish being made. Wood-fire oven glowing orange.
    Farm ingredients arriving by the basket. No secrets. Just craft.
  Feature pills: [🔥 Wood-fire] [🫕 Open Kitchen] [🌿 Farm Ingredients]
GSAP: text slides from x:60→0, opacity:0→1 as photo parallaxes slightly

--- SCENE 5: "TO YOUR TABLE" ---
Clean, cream bg (earth-200), centered
H2 (Playfair, farm-600, 3rem): "Come taste the difference."
Body: "From the highland fields of Berastagi to the dish in front of you —
  every ingredient has a story. Come hear it."
Two CTAs: [Reserve a Table] (large, farm-600) + [View the Menu]
Stats: 20+ Years · 5 Artisan Cheeses · Open Kitchen · Farm to Table Since 2005
GSAP: entire section fades up as unit on scroll

--- AFTER SCENES: Standard sections ---
Featured Menu (3 cards, from is_featured=true items in DB)
Active Promos strip (from promos table)
Testimonial banner (farm-600 bg, Playfair italic quote, white)
Sister site bridge:
  Background: DJI_0016-1.jpg (drone shot of full property)
  Overlay: dark green gradient
  Content: "The farm is just minutes away."
  H3: "Visit Gundaling Farm" → gundalingfarm.com prominent CTA

====================================================================
PAGE 2: MENU (/menu)
====================================================================

DB query: MenuCategory::where('is_active',true)->with(['items' => fn($q) => $q->where('is_available',true)->orderBy('sort_order')])->orderBy('sort_order')->get()

Layout:
Sticky category nav (Alpine.js tabs, top-0 z-40, farm-900 bg):
  x-data="{ active: '{{ $categories->first()->slug }}', type: 'food' }"
  Tabs scroll horizontally on mobile
  Active tab: farm-600 bg + white text (GSAP underline slide animation)

Foods/Drinks toggle at top (Alpine x-show)

Per category section (id="{{ $cat->slug }}"):
  Section H2: category name (Playfair, farm-950, 1.8rem)
  Item grid: grid-cols-1 md:grid-cols-2 lg:grid-cols-3, gap-6

Menu item card design:
  Aspect-video image (object-cover, rounded-xl) OR color-coded placeholder
  Top-right: badge chip "Signature" / "New" / "Spicy" (if set)
  SOLD OUT overlay: absolute inset-0, bg-red-600/65, rounded-xl
    Centered text: "SOLD OUT" (white, tracking-widest, uppercase Nunito)
  Name: Playfair 1.1rem, farm-950
  Description: Nunito sm, earth-600, line-clamp-2
  Price: Nunito bold, farm-600 — Rp {{ number_format($item->price,0,',','.') }}
  Bottom: "🌿 From our farm" badge if is_featured

Indonesian: @if(app()->getLocale() === 'id') show name_id/description_id @endif

GSAP: items stagger y:20→0 opacity:0→1 as they scroll into view

====================================================================
PAGE 3: RESERVATION (/reservations)
====================================================================

Header background: Supriadi_golden_hour-_17-07-22-5.jpg (same as hero)
  60vh height, dark overlay, H1 "Reserve Your Table"

Two-column layout:
LEFT: Reservation form (Blade + Alpine.js)
  x-data="{ 
    step: 1, maxStep: 3,
    form: {name:'',email:'',phone:'',date:'',time:'',guests:1,occasion:'',notes:'',isGroup:false,groupName:''},
    next() { this.step++ }, back() { this.step-- }
  }"

  Step 1 (Contact): Name, Email, WhatsApp Number
  Step 2 (Visit): Date (min today), Time (select 10:00–19:00),
    Guests (number 1–500), Occasion (select)
    Toggle: "This is a large group (10+ guests)" → shows Group Name field
  Step 3 (Review + Notes): Summary of selections + Notes textarea
    [Confirm Reservation] button

  On submit POST /reservations:
    Validate → store → redirect to /reservations/confirmation/{id}

  Confirmation page:
    Booking summary card (farm-600 accent)
    WA button: "Confirm via WhatsApp" pre-filled message
    Note: "We'll confirm your booking within 2 hours via WhatsApp."

RIGHT: Info panel
  Hours, dress code note, address
  OpenStreetMap iframe (no API key):
    src="https://www.openstreetmap.org/export/embed.html?bbox=98.504,3.184,98.514,3.193&layer=mapnik&marker=3.1885,98.5092"
    class="w-full h-64 rounded-2xl border-0"

BEO SECURITY:
  storage/app/private/beos/ (NOT public disk)
  Download route protected: middleware(['auth','verified'])
  Filament staff uploads → file never touches public directory

====================================================================
PAGE 4: PROMO (/promo)
====================================================================

Header: Resto.jpg (stone pathway entrance + sign)
  "Special Offers & Promotions" H1 overlay, dark gradient

Featured hero card (first active promo):
  Full-width split — left: promo image, right: content
  GSAP: slide in from right on page load

Promo grid: grid-cols-1 md:grid-cols-2 lg:grid-cols-3
  Card: image, tag badge, title (Playfair), description, valid_until
  Empty state: "Check back soon — new promos coming." (farm mascot optional)
  GSAP: stagger card entrance on scroll

WA notify bar:
  earth-200 bg, centered
  "Want to be the first to know about new promos?"
  [Message us on WhatsApp ↗] → wa.me with pre-fill "I'd like to receive Gundaling Farmstead promo updates"

====================================================================
PAGE 5: ABOUT (/about)
====================================================================

Hero: DJI_0016-1.jpg (drone aerial, restaurant + gardens + mountains)
  Full-width, 70vh, dark overlay
  H1: "Our Story" · Subtitle: "Est. 2005 · Berastagi, North Sumatra"
  GSAP: SplitText title reveal

Timeline (horizontal desktop, vertical mobile):
Background: resto_farm.PNG at 15% opacity behind the timeline
  Progress line: GSAP scaleX 0→1 on ScrollTrigger scrub:1
  4 milestones:
    2005 → "Farm established. The cows planned it for us."
    2018 → "Cheese production begins. First Tomme aged."
    2019 → "Restaurant opens. Open kitchen, farm to table."
    Now  → "Working farm + restaurant + agritourism destination."
  Each dot: GSAP scale 0.5→1, opacity 0→1, stagger 0.3s (starts at scrub 0.5)

Founder quote (large):
  Decorative SVG quotation marks (farm-600, 6rem)
  Playfair italic 1.4rem: "We did not plan to become a restaurant.
    The cows planned it for us."
  GSAP: fadeUp + opacity reveal on scroll

Story blocks: A Journey That Started with Fertilizer | From Milk to Cheese
  Why Farm to Table Matters to Us (content from existing about.html)

Values grid: Fresh · Quality · Natural · Made With Love
  Icon + title + 2-line description per value
  GSAP: stagger from below on scroll

Farm cross-link:
  Background: supriadi-lee-pims-9_orig.jpg (farm + erupting Sinabung)
  "The farm is where it all begins."
  [Visit Gundaling Farm ↗] → gundalingfarm.com

====================================================================
PAGE 6: CONTACT (/contact)
====================================================================

Header: Resto.jpg (entrance path) — same as Promo page, different crop
  "Visit Us" H1, "We'd love to welcome you" subtitle

Left column — Info:
  Address, Hours (Farm / Restaurant), Phone
  [Chat on WhatsApp ↗] → wa.me (primary CTA, farm-600 bg button)
  Email, Instagram, Facebook
  OpenStreetMap iframe (rounded-2xl, h-72)

Right column — Form (Alpine.js):
  x-data="{ form:{name:'',email:'',subject:'',message:''}, sending:false, sent:false,
    async submit() {
      this.sending = true;
      const r = await fetch('/contact', {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content},
        body: JSON.stringify(this.form)
      });
      this.sending = false; this.sent = true;
    }}"
  
  Fields: Name, Email, Subject (select options), Message (textarea 5 rows)
  Submit: [Send Message] with spinner state (x-show="sending")
  Success: x-show="sent" — green checkmark + "Message sent! We'll reply within 24 hours."
  NO alert() calls anywhere

Sister site cross-link at bottom:
  "Looking for farm products or field trips?"
  [Visit Gundaling Farm →] gundalingfarm.com

====================================================================
ERROR PAGES (resources/views/errors/)
====================================================================

SHARED LAYOUT for error pages (self-contained, no @extends):
  Inline CSS only (no Vite/Tailwind required — app may not boot)
  Farm green bg (#1E2F1C), cream text (#F9F6EF)
  Logo.png centered top
  Mascot image centered
  Tagline + buttons

404.blade.php:
  Mascot: 7_-_Copy.png (waving cow, question/friendly)
  Tagline: "This pasture doesn't exist."
  Subtitle: "The page you're looking for has wandered off."
  Buttons: [Home] [View Menu]

403.blade.php:
  Mascot: 7_-_Copy.png
  Tagline: "This field is fenced off."
  Subtitle: "You don't have permission to enter this area."
  Buttons: [Home] [WhatsApp →]

419.blade.php:
  Mascot: 7_-_Copy.png
  Tagline: "That took a while."
  Subtitle: "Your session expired. Please go back and try again."
  Buttons: [← Go Back (js:history.back())] [Home]

429.blade.php:
  Mascot: 7_-_Copy.png
  Tagline: "Slow down there."
  Subtitle: "Too many requests. Please wait a moment."
  Buttons: [Home]

500.blade.php:
  Mascot: Use a sad/error variant — describe as cow_mascot_error.png
  (you'll provide this image — for now use 7_-_Copy.png as placeholder)
  Tagline: "Something burned in the kitchen."
  Subtitle: "Our team has been notified. We're fixing it now."
  Buttons: [Home] [WhatsApp →]

503.blade.php:
  Mascot: cow_mascot_error.png (placeholder: 7_-_Copy.png)
  Tagline: "Back at the farm for a moment."
  Subtitle: "We're doing some maintenance. Back shortly!"
  Buttons: [WhatsApp →] only
  NO @extends, NO DB queries, NO Vite — fully self-contained HTML

====================================================================
SHARED LAYOUT (resources/views/layouts/app.blade.php)
====================================================================

HEAD:
  <meta name="csrf-token" content="{{ csrf_token() }}">
  Google Fonts: Playfair Display + Nunito
  Vite: @vite(['resources/css/app.css','resources/js/app.js'])
  hreflang alternates
  Schema.org JSON-LD (home page only via @section('schema'))

NAVIGATION (Alpine.js):
  x-data="{ scrolled:false, open:false,
    init() { window.addEventListener('scroll', () => this.scrolled = window.scrollY > 60) }}"
  :class="scrolled ? 'bg-farm-900/95 backdrop-blur-md shadow-lg py-3' : 'bg-transparent py-5'"
  Logo: brightness-0 invert (white against dark nav)
  Links: Home Menu Promo About Contact + [EN|ID] switcher
  Sister link: "🌿 Gundaling Farm ↗" → gundalingfarm.com
  CTA: "Reserve a Table" → gold pill → /reservations

FOOTER:
  Walking mascot strip (80px, farm-900 bg):
    #walk-mascot: absolute, h-16, GSAP x:-80→windowWidth+80, 14s, infinite, linear
    Body bob: GSAP y:0→-3→0, 0.45s, infinite, ease:"sine.inOut"
    Green grass strip (4px) at bottom
  
  Footer grid (lg:grid-cols-4):
    Brand | Restaurant links | The Farm links | Find Us
    Brand: Logo.png (h-14, white filter), tagline, badges
    Badges: [🌱 Organic] [⭐ Est. 2005] [🔥 Open Kitchen]
  
  Bottom: © 2025 Gundaling Farmstead · PT. Putra Indo Mandiri Sejahtera
  Links: pimsgundaling.com | gundalingfarm.com

WHATSAPP FLOAT:
  GSAP: from({scale:0,opacity:0}, {scale:1,opacity:1,duration:0.5,ease:"back.out(1.7)",delay:3})
  Fixed bottom-8 right-8, z-50
  #25D366 bg, 56px circle
  WhatsApp SVG icon white
  href="https://wa.me/6281234567890?text=Halo+Gundaling+Farmstead%2C..."

====================================================================
SEO
====================================================================

All pages:
  lang="en" (or "id" on /id/ routes)
  Canonical tags
  OG meta tags

Per page titles (EN):
  Home:    "Gundaling Farmstead | Farm-to-Table Restaurant · Berastagi"
  Menu:    "Menu | Gundaling Farmstead Restaurant Berastagi"
  Reserv:  "Reserve a Table | Gundaling Farmstead Berastagi"
  Promo:   "Special Offers | Gundaling Farmstead Berastagi"
  About:   "Our Story | Gundaling Farmstead Est. 2005"
  Contact: "Visit Us | Gundaling Farmstead Berastagi"

Schema JSON-LD (home only):
{
  "@context":"https://schema.org","@type":"Restaurant",
  "name":"Gundaling Farmstead",
  "url":"https://gundalingfarmstead.com",
  "telephone":"+6281234567890",
  "address":{"@type":"PostalAddress",
    "streetAddress":"Jl. Jamin Ginting, Desa Jaranguda",
    "addressLocality":"Berastagi","addressRegion":"Sumatera Utara",
    "postalCode":"22158","addressCountry":"ID"},
  "geo":{"@type":"GeoCoordinates","latitude":3.1885,"longitude":98.5092},
  "servesCuisine":["Indonesian","Western","Farm to Table","Karo"],
  "openingHours":"Mo-Su 10:00-20:00"
}

====================================================================
PERFORMANCE
====================================================================

Hero images: loading="eager" fetchpriority="high"
All other images: loading="lazy"
Hero skeleton: farm-900 bg div that fades out on JS window.load
GSAP: lazy-load ScrollTrigger only when user starts scrolling
  (use import() dynamic for ScrollTrigger in app.js)
Mascot in footer: 64px PNG only, never the 1.1MB SVG
.htaccess: AddOutputFilterByType DEFLATE text/html text/css
  application/javascript image/svg+xml

prefers-reduced-motion:
  const mm = gsap.matchMedia();
  mm.add("(prefers-reduced-motion: no-preference)", () => {
    // all GSAP ScrollTrigger and animation code here
  });

GSAP INIT ORDER (critical — wrong order breaks all animations):
  1. HTML renders → hero skeleton div visible immediately
  2. document.fonts.ready → init GSAP + SplitText hero title reveal
  3. heroImg onload → fade skeleton, mascot spring entry, idle float
  4. window.load → ScrollTrigger.refresh() then all scene reveals
  5. Never put ScrollTrigger.create() before window.load
  6. Never put SplitText before document.fonts.ready

Hero image attributes (both sites):
  id="hero-img" loading="eager" fetchpriority="high"

Mascot initial CSS state (set before GSAP runs):
  .mascot-hero { opacity: 0; transform: translateX(60px) scale(0.85); }

Hero skeleton (both sites):
  position:absolute; inset:0; z-index:5; background:#0e1810;
  + shimmer animation (optional gold line at bottom)
  Removed from DOM on heroImg load via gsap.to → onComplete → remove()

/* ─── GSAP INIT PATTERN (app.js / inline script) ─── */
```js
// 1. HERO SKELETON — shows instantly, hides when ready
const skeleton = document.getElementById('hero-skeleton');
const heroImg = document.getElementById('hero-img');

// 2. WAIT FOR FONTS (SplitText needs correct letter widths)
await document.fonts.ready;

// 3. INIT GSAP — before images, for anything above the fold
gsap.registerPlugin(ScrollTrigger, SplitText);

const mm = gsap.matchMedia();
mm.add("(prefers-reduced-motion: no-preference)", () => {

  // Hero title split — runs after fonts.ready, safe
  const split = new SplitText(".hero-title", { type: "words" });
  gsap.from(split.words, {
    y: 60, opacity: 0, duration: 0.75, stagger: 0.05,
    ease: "power3.out", delay: 0.2
  });

  // Mascot: hidden until hero image loads
  gsap.set(".mascot-hero", { opacity: 0 });

  // 4. WAIT FOR HERO IMAGE → fade skeleton + mascot entry
  function heroReady() {
    gsap.to(skeleton, {
      opacity: 0, duration: 0.6, ease: "power2.out",
      onComplete: () => skeleton.remove()
    });
    gsap.to(".mascot-hero", {
      opacity: 1, x: 0, scale: 1,
      duration: 0.9, ease: "back.out(1.7)", delay: 0.2
    });
    gsap.to(".mascot-hero", {
      y: -10, repeat: -1, yoyo: true,
      duration: 3.6, ease: "sine.inOut", delay: 1.2
    });
  }

  if (heroImg.complete) {
    heroReady();
  } else {
    heroImg.addEventListener('load', heroReady);
    heroImg.addEventListener('error', heroReady);
  }

  // 5. ALL SCROLLTRIGGER — after window.load (layout stable)
  window.addEventListener('load', () => {
    ScrollTrigger.refresh();
    initScrollAnimations();
  });

});
```

<!-- Farmstead (Blade): above the hero bg image -->
```html
<div id="hero-skeleton"
  style="position:absolute;inset:0;z-index:5;
    background:#0e1810;
    transition:opacity 0.6s ease;
    pointer-events:none"
>
  <div style="position:absolute;bottom:0;left:0;right:0;
    height:2px;background:linear-gradient(90deg,
    transparent,rgba(245,197,66,0.4),transparent);
    animation:shimmer 1.8s ease-in-out infinite"></div>
</div>

<img id="hero-img" src="..." class="hero-bg"
  loading="eager" fetchpriority="high" alt="..." />

<img src="mascot.svg" class="mascot-hero"
  style="opacity:0;transform:translateX(60px) scale(0.85)" alt="..." />
```

```css
@keyframes shimmer {
  0%, 100% { opacity: 0.6; }
  50%       { opacity: 0.2; }
}
```

====================================================================
QUALITY CHECKLIST
====================================================================
[ ] All GSAP animations inside prefers-reduced-motion matchMedia block
[ ] GSAP easing: never "ease-in" for entering elements
[ ] GSAP duration: micro <250ms, section reveals <900ms
[ ] Emil skill: no hover:scale-105 on-everything anti-pattern
[ ] Taste skill: no two adjacent sections look the same (vary bg, layout)
[ ] BEO files: storage/app/private/beos/ — never public disk
[ ] BEO download: auth middleware on route
[ ] Sold-out toggle: prominent in Filament table + red overlay on frontend
[ ] No alert() anywhere — Alpine x-show for all feedback
[ ] OpenStreetMap embed — no Google Maps API key
[ ] WA links: wa.me/628... with URL-encoded pre-fill
[ ] Schema JSON-LD: home page only
[ ] hreflang: every page, both en and id variants
[ ] Error pages: 404, 403, 419, 429, 500, 503 all exist in resources/views/errors/
[ ] 503.blade.php: fully self-contained (no @extends, no DB, no Vite)
[ ] Logo.png: brightness-0 invert on dark nav bg
[ ] Photos assigned correctly: golden-hour-17 for hero, fisheye-19 for night section
[ ] Footer: © 2025 Gundaling Farmstead — PT. Putra Indo Mandiri Sejahtera
[ ] Sister site link gundalingfarm.com: in nav + footer + farm cross-link sections
```
