# Design System Master File

> **LOGIC:** When building a specific page, first check `design-system/pages/[page-name].md`.
> If that file exists, its rules **override** this Master file.
> If not, strictly follow the rules below.

---

Apply UI UX Pro Max style: PARALLAX STORYTELLING (#31) + ORGANIC BIOPHILIC (#24)
Use Magic MCP /ui for: reservation form widget, menu card components, admin dashboard widgets.

Build the complete Gundaling Farmstead restaurant website.

===================================================================
BRAND
===================================================================
Name:       Gundaling Farmstead Restaurant
Domain:     gundalingfarmstead.com  
Main hub:   pimsgundaling.com (links back here)
Farm site:  gundalingfarm.com (sister site, cross-linked)
Company:    PT. Anugerah Alam Berastagi
Address:    Jl. Jamin Ginting, Desa Jaranguda, Simpang Pelawi,
            Kabupaten Karo, Berastagi 22158, North Sumatra, Indonesia
Phone:      +62 812-3456-7890
Email:      info@gundalingfarmstead.com
WA:         https://wa.me/6281234567890
Instagram:  @gundaling_farmstead
Coords:     lat 3.1885, lng 98.5092
Hours:      Restaurant 10:00–20:00 (last order 19:00) daily

Primary language: English
Secondary language: Indonesian (via /id/ route prefix)

COLORS (Tailwind config):
farm-950: #0e1810  farm-900: #162318  farm-800: #1E2F1C
farm-700: #1E4B1F  farm-600: #2C5F2D  farm-500: #3d7a3e
farm-400: #4a9c56  farm-300: #82be89  farm-200: #b3d9b7
farm-100: #d8ecda  farm-50:  #f0f7ef

earth-900: #1f120a  earth-800: #3d2414  earth-700: #5c3620
earth-600: #7B4B2D  earth-500: #a0845e  earth-400: #c4a882
earth-300: #E6D5B8  earth-200: #F9F6EF  earth-100: #f9f1e7
earth-50:  #fdf8f3

gold: #F5C542    amber: #E8943A    fire: #D4520E

FONTS:
display: "Playfair Display" (headings, hero, section titles)
body:    "Nunito" (all body text, UI, prices)

ASSETS (actual paths under /public/images/):
/images/hero/hero-farm.jpg                                   - aerial shot, Mt. Sinabung erupting in background
/images/restaurant/story.jpg                                  - restaurant interior, warm wood, dried hanging plants
/images/promo/promo-cheese.jpg                                - artisan cheese platter on wooden board
/images/logos/Logo_GUNDALING_2-color_tall_on-white.png        - Farmstead badge logo (2-color, tall, on white)
/images/mascot/cow_mascot_apron.svg                           - Holstein cow in apron, primary mascot (flat SVG)
/images/mascot/cow_mascot_apron.png                           - PNG version, used for motion.dev scene animations
/images/mascot/cow_mascot_vector.svg / .png                   - secondary vector variant (unused unless a scene calls for it)

MENU PHOTOS (real photo library, under /images/menu/<category>/):
appetizers, cheese, desserts, drinks, pasta, pizza, western — populated
gelato, karo, tasteOfKaro — EMPTY, no photos yet
  → menu_items.image stays nullable; frontend falls back to a placeholder
    gradient/icon card (no broken image) for items without a photo.
  → Seeder should map menu_items to these category folders by filename.

MASCOT ANIMATION RULES:
- Primary mascot across the site (hero float, footer walk strip, About wave): cow_mascot_apron.svg
- Use <img src="/images/mascot/cow_mascot_apron.svg"> (hero/footer/static) or
  <img src="/images/mascot/cow_mascot_apron.png"> (Scene 2 motion.dev scene), NEVER inline the SVG
- Animate ONLY the wrapper element via CSS or motion.dev
- Animations: idle float (translateY 0↔-10px, 3.6s), walk (translateX, 14s),
  entry spring (cubic-bezier 0.34,1.56,0.64,1), ground glow radial pulse

===================================================================
STACK
===================================================================
Framework:   Laravel 11 (Blade templates)
Admin:       Filament v3 (full CMS)
CSS:         Tailwind CSS v4 via @tailwindcss/vite
Animations:  motion.dev (vanilla JS Framer Motion)
Interactivity: Alpine.js v3 + @alpinejs/intersect
i18n:        Laravel localization, /id/ route prefix for Indonesian
DB:          MySQL (via Laravel Eloquent)
Auth:        Laravel Breeze (admin-only, staff login)
Maps:        OpenStreetMap iframe (no API key needed)
WhatsApp:    wa.me links with pre-filled text

===================================================================
DATABASE SCHEMA
===================================================================

Create these migrations:

-- menu_categories
id, name:string, name_id:string(Indonesian), slug, sort_order:int,
is_active:bool, icon:string(nullable), image:string(nullable),
created_at, updated_at

-- menu_items
id, category_id(FK), name:string, name_id:string,
description:text, description_id:text,
price:decimal(10,2), image:string(nullable),
is_available:bool(default true), is_featured:bool,
is_sold_out:bool(default false), badge:string(nullable),
sort_order:int, created_at, updated_at

-- promos
id, title:string, title_id:string, description:text, description_id:text,
image:string(nullable), tag:string, tag_id:string,
valid_until:date(nullable), is_active:bool, sort_order:int,
created_at, updated_at

-- reservations
id, name:string, email:string, phone:string,
date:date, time:time, guests:int,
occasion:string(nullable), notes:text(nullable),
status:enum[pending,confirmed,cancelled,completed,beo_uploaded](default pending),
wa_sent:bool(default false),
beo_file:string(nullable),  ← staff uploads BEO PDF here
group_name:string(nullable),
created_at, updated_at

-- pages (for About, Contact editable sections)
id, key:string(unique), content:json, updated_at

Run: php artisan migrate
Run: php artisan db:seed (seed sample menu categories and items)

===================================================================
FILAMENT ADMIN PANEL  (/admin)
===================================================================

Build these Filament Resources:

1. MenuCategoryResource
   - List: table with sort_order, name, is_active toggle, item count badge
   - Form: name(EN), name_id(ID), slug(auto), icon, image upload, sort_order, is_active
   - Reorderable table rows (drag sort)

2. MenuItemResource
   - List: table with category (select filter), name, price, is_available toggle,
     is_sold_out toggle (most used — make it a prominent inline toggle), is_featured
   - Form: category(select), name(EN+ID), description(EN+ID), price, image upload,
     is_available, is_sold_out, is_featured, badge(e.g. "New" "Signature" "Spicy"), sort_order
   - Bulk actions: mark sold out, mark available, toggle featured

3. PromoResource
   - List: table with title, tag, valid_until, is_active toggle, preview image thumb
   - Form: title(EN+ID), description(EN+ID), tag(EN+ID), image upload,
     valid_until(date picker), is_active, sort_order

4. ReservationResource
   - List: table with name, date, time, guests, status badge (color coded), wa_sent, beo
   - Filters: date range, status, has_beo
   - View action: shows full reservation details
   - Status select action: change status inline
   - BEO upload action: staff clicks "Upload BEO" → file upload (PDF only, max 10MB)
     → stored in storage/app/private/beos/ (NOT publicly accessible)
     → only downloadable by authenticated admin users
   - WA Link action: opens pre-filled WhatsApp link for confirmation message
     pre-fill: "Hi [name], your reservation at Gundaling Farmstead on [date] at [time]
     for [guests] guests is confirmed. We look forward to welcoming you!"
   - Export: CSV export of reservations by date range
   - Security: BEO files NEVER exposed publicly. Download route protected by auth middleware.

5. PageContentResource (optional, simple)
   - Editable JSON blocks for About page story text and Contact page info

Filament dashboard widgets:
- Today's reservations count + upcoming 7 days count
- Menu items currently sold out (with quick un-mark button)
- Active promos count
- Recent reservations list (last 5)

===================================================================
ROUTES  (web.php)
===================================================================

// --- PUBLIC ENGLISH (default) ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/reservations', [ReservationController::class, 'create'])->name('reservations');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/confirmation/{id}', [ReservationController::class, 'confirmation']);
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// --- INDONESIAN ROUTES ---
Route::prefix('id')->name('id.')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservations');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/promo', [PromoController::class, 'index'])->name('promo');
    Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
    Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
});

// --- SECURE BEO DOWNLOAD (admin only) ---
Route::middleware(['auth', 'role:admin,staff'])
    ->get('/secure/beo/{reservation}', [ReservationController::class, 'downloadBeo'])
    ->name('beo.download');

// Middleware: detect locale from route prefix, set App::setLocale()

===================================================================
i18n IMPLEMENTATION
===================================================================

1. Create lang/en/ and lang/id/ folders
2. Key translation files:
   - lang/en/nav.php, lang/id/nav.php
   - lang/en/home.php, lang/id/home.php
   - lang/en/menu.php, lang/id/menu.php
   - lang/en/reservations.php, lang/id/reservations.php
   - lang/en/common.php, lang/id/common.php (shared: buttons, labels, footer)

3. Locale middleware: reads route prefix /id/ → sets locale to 'id'
   Default (no prefix) → locale 'en'

4. Language switcher in nav:
   <a href="{{ route(str_replace('id.', '', Route::currentRouteName())) }}">EN</a>
   <a href="{{ route('id.' . str_replace('id.', '', Route::currentRouteName())) }}">ID</a>

5. Menu items: display name_id / description_id when locale = 'id'
   In Blade: {{ app()->getLocale() === 'id' ? $item->name_id : $item->name }}
   Or create helper: $item->localName() → returns correct language field

6. SEO hreflang in <head>:
   <link rel="alternate" hreflang="en" href="https://gundalingfarmstead.com{{ request()->path() }}"/>
   <link rel="alternate" hreflang="id" href="https://gundalingfarmstead.com/id/..."/>

===================================================================
PAGE 1: HOME (/)  — IMMERSIVE SCROLL
===================================================================

This is the centerpiece. Use motion.dev for scroll-triggered scene reveals.
Structure as a vertical narrative: user scrolls through the farm-to-table story.

SCENE 0 — FULL SCREEN HERO
- Background: /images/hero/hero-farm.jpg (cover, fixed parallax via motion.dev scroll)
- Dark overlay gradient: black/50 to black/70
- Center-right: /images/mascot/cow_mascot_apron.svg (h-96) with idle float animation (motion.animate)
- Left content (max-w-xl):
  - Eyebrow: "Est. 2005 · Berastagi, North Sumatra" + animated pulse dot
  - H1 (Playfair, 4xl–6xl clamp): "Where the Farm Meets Your Fork"
  - Subtext (Nunito, lg): 2-line brand description
  - CTA row: [View Menu →] (farm-600 bg) + [Reserve a Table] (white outline)
- Bottom: animated chevron bounce indicating scroll

SCENE 1 — "IT STARTS ON THE FARM" (scroll reveal)
motion.dev: as user scrolls into view, image slides in from left, text from right
- Left: /images/hero/hero-farm.jpg in rounded-3xl frame (aspect-video)
- Right: 
  - Section label: "The Farm · Step 1 of 5"
  - H2 (Playfair): "It starts on the farm"
  - Body: Highland cows grazing at 1,400m elevation. Cool air. Volcanic soil.
  - Link: → "Visit the Farm" (links to gundalingfarm.com)
- motion.dev: image enters from x:-60, text from x:60, opacity 0→1 on scroll

SCENE 2 — "THEN COMES THE MILK" (scroll reveal, reverse layout)
- Right: cow mascot PNG (/images/mascot/cow_mascot_apron.png, h-64) with gentle tilt animation
  + animated milk bottle illustration (CSS or simple SVG)
- Left: 
  - Section label: "The Dairy · Step 2 of 5"
  - H2: "Fresh milk, every morning"
  - Body: Holstein herd. Daily milking. Pasteurised on-site. No additives.
  - Product pills: [Fresh Milk] [Yogurt] [Gelato] [Cheese]
  (each pill links to gundalingfarm.com products)

SCENE 3 — "AGED IN OUR CELLAR" (cheese scene)
- Full width dark section (farm-950 bg)
- Background: /images/promo/promo-cheese.jpg at 20% opacity (overlay)
- Foreground: centered text + floating cheese card grid
- H2 (Playfair, white): "Five cheeses. All made here."
- 5 cheese cards (grid, horizontal scroll on mobile):
  Mozzarella / Gundaling Cheese / Curd / Sinabung Tomme / Andaliman Tomme
  Each card: name, aging time, flavor note
- motion.dev: cards stagger-enter from below (y:40→0, stagger 0.12s each)

SCENE 4 — "INTO THE OPEN KITCHEN" (restaurant scene)
- Background: /images/restaurant/story.jpg (the real restaurant interior photo) full width
- Gradient overlay: transparent → farm-950/80 from right
- Right side text:
  - Section label: "The Kitchen · Step 4 of 5"
  - H2 (white Playfair): "Our kitchen is open. Always."
  - Body: Watch every dish being prepared. Wood-fire oven. Farm ingredients.
  - Feature row: [🔥 Wood-fire] [🫕 Open Kitchen] [🌿 Farm Ingredients]

SCENE 5 — "TO YOUR TABLE" (final reveal CTA)
- Clean cream background (earth-200)
- Center: /images/mascot/cow_mascot_apron.svg (h-48) with happy bounce animation
- H2 (Playfair, farm-600): "Come taste the difference."
- Subtext: "From the highland fields of Berastagi to the dish in front of you —
  every ingredient has a story. Come hear it."
- CTA: [Reserve a Table] (large, farm-600 pill) + [View the Menu]
- Stats strip: 20+ Years Farming · 5 Artisan Cheeses · Open Kitchen · Est. 2005

AFTER SCENES: standard sections
- Featured Menu Highlights (3-4 cards pulled from menu_items where is_featured=true)
- Active Promos strip (pulled from promos where is_active=true)
- Testimonial quote banner (farm-600 bg, white Playfair italic)
- CTA to sister site: "Also visit Gundaling Farm →" (links to gundalingfarm.com)

motion.dev implementation:
```javascript
import { animate, scroll, inView } from "motion";

// Parallax hero
scroll(animate(".hero-bg", { y: [0, -120] }), {
  target: document.querySelector("#hero")
});

// Scene reveals
inView(".scene", ({ target }) => {
  animate(target.querySelector(".scene-img"),
    { opacity: [0, 1], x: [-60, 0] },
    { duration: 0.8, easing: [0.25, 0.46, 0.45, 0.94] }
  );
  animate(target.querySelector(".scene-text"),
    { opacity: [0, 1], x: [60, 0] },
    { duration: 0.8, delay: 0.15, easing: [0.25, 0.46, 0.45, 0.94] }
  );
});

// Stagger cards
inView(".cheese-grid", ({ target }) => {
  animate(target.querySelectorAll(".cheese-card"),
    { opacity: [0, 1], y: [40, 0] },
    { duration: 0.6, delay: stagger(0.12) }
  );
});

// Mascot idle float
animate(".mascot-idle",
  { y: [0, -10, 0] },
  { duration: 3.6, repeat: Infinity, easing: "ease-in-out" }
);
```

===================================================================
PAGE 2: MENU (/menu)
===================================================================

Controller: pull all active categories with their available items.
Group items by category. Pass to Blade as $categories collection.

Layout:
- Sticky category nav bar (Alpine.js tabs):
  x-data="{ active: '{{ $categories->first()->slug }}' }"
  Each tab: @click="active = cat.slug" :class="active===cat.slug ? 'bg-farm-600 text-white' : ''"
  
- "Foods" / "Drinks" top toggle (Alpine.js)
  x-data="{ type: 'food' }" — filters which categories show

- Category sections (each has id="{{ $cat->slug }}" for jump nav)
  - Section heading: cat.name (Playfair h2, farm-600)
  - Item grid (grid-cols-1 md:grid-cols-2 lg:grid-cols-3)

Menu item card:
- Image (aspect-video, rounded-xl, object-cover) OR placeholder gradient
- Top-right badge chip: "Signature" / "New" / "Spicy" (if set)
- "SOLD OUT" overlay (red/60 semi-transparent) if is_sold_out=true
- Item name (Playfair, farm-950)
- Description (Nunito sm, earth-600)
- Price (Nunito font-bold, farm-600): Rp {{ number_format($item->price, 0, ',', '.') }}
- Bottom: "From our farm" 🌿 badge if item uses farm ingredients (is_featured or flag)

Sold out display:
@if($item->is_sold_out)
  <div class="absolute inset-0 bg-red-500/60 rounded-xl flex items-center justify-center">
    <span class="text-white font-bold tracking-widest uppercase text-sm">Sold Out</span>
  </div>
@endif

Indonesian: when locale=id, show $item->name_id and $item->description_id

motion.dev: items stagger-reveal on scroll (y:20→0, opacity 0→1)

===================================================================
PAGE 3: RESERVATION (/reservations)
===================================================================

Two-column layout:
LEFT: Reservation form (Laravel + Alpine.js)
RIGHT: Info panel (hours, map, mascot)

Form fields (Blade + Alpine.js validation):
- Full Name (required)
- Email (required)
- WhatsApp Number (required, format: 08xx or +62xx)
- Date (date picker, min = today, required)
- Time (select: 10:00, 11:00... 19:00, required)
- Number of Guests (number, min 1, max 500)
- Occasion (select: Birthday / Anniversary / Business Dinner / Wedding / Large Group / Other)
- Special Notes (textarea, optional)
- Checkbox: "This is a large group or event (10+ guests)" → if checked, shows extra field:
  Group/Event Name (text input)

On submit (POST /reservations):
1. Validate all fields
2. Store in reservations table, status='pending'
3. Redirect to /reservations/confirmation/{id}

Confirmation page:
- Success message with booking summary
- WA Button: "Confirm via WhatsApp" →
  href="https://wa.me/6281234567890?text=Hi+Gundaling+Farmstead%2C+I%27ve+just+made+a+reservation+online.+Name%3A+[name]%2C+Date%3A+[date]%2C+Time%3A+[time]%2C+Guests%3A+[guests]"
- Note: "Our team will confirm your booking within 2 hours."
- Small /images/mascot/cow_mascot_apron.svg waving

Staff BEO flow (admin only):
- In Filament admin → Reservations → find booking
- Click "Upload BEO" → upload PDF
- File stored: storage/app/private/beos/reservation_{id}.pdf
- Download route: GET /secure/beo/{reservation} (auth middleware)
- Status auto-updates to 'beo_uploaded'

===================================================================
PAGE 4: PROMO (/promo)
===================================================================

Pull from promos table where is_active=true, ordered by sort_order.

Featured hero card (first/pinned promo):
- Full-width card, split layout
- Left: promo image (or /images/promo/promo-cheese.jpg as default)
- Right: tag badge, title, description, valid_until

Promo grid (remaining promos):
- grid-cols-1 md:grid-cols-2 lg:grid-cols-3
- Card: image top, tag badge, title (Playfair), description, valid_until
- motion.dev stagger entrance

WhatsApp notify bar at bottom:
- earth-200 bg, centered
- Text: "Want early access to our promos?"
- Button: "Message us on WhatsApp" → wa.me link

===================================================================
PAGE 5: ABOUT (/about)
===================================================================

HERO: /images/restaurant/story.jpg full-width, overlay, "Our Story" H1

TIMELINE (horizontal desktop, vertical mobile):
- 2005: Farm established. "The cows planned it for us."
- 2018: Cheese production begins. First Tomme aged.
- 2019: Restaurant opens. Open kitchen, farm-to-table.
- Now: Working farm + restaurant + agritourism destination.
motion.dev: connector line draws left-to-right on scroll (clipPath animation)

STORY TEXT blocks:
- "A Journey That Started with Fertilizer" (Andreas founder story)
- "From Milk to Cheese" (cheese making craft)
- "Why Farm to Table Matters to Us" (philosophy)

FOUNDER QUOTE:
- Large decorative SVG quotation marks (farm-600 color)
- Playfair italic quote: "We did not plan to become a restaurant. The cows planned it for us."

CTA: "Come visit the farm" → gundalingfarm.com

===================================================================
PAGE 6: CONTACT (/contact)
===================================================================

LEFT COLUMN:
- Address block
- Hours block (Farm / Restaurant)
- Phone + WA button: "Chat on WhatsApp" → wa.me
- Email
- Instagram / Facebook links
- OpenStreetMap iframe:
  src="https://www.openstreetmap.org/export/embed.html?bbox=98.504,3.184,98.514,3.193&layer=mapnik&marker=3.1885,98.5092"
  width="100%" height="280" rounded-xl border-0

RIGHT COLUMN: Contact Form (Alpine.js)
x-data="{
  form: { name:'', email:'', subject:'', message:'' },
  sending: false, sent: false,
  async submit() {
    this.sending = true;
    const res = await fetch('/contact', { method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN': csrfToken},
      body: JSON.stringify(this.form)
    });
    this.sending = false;
    this.sent = true;
  }
}"

On send: store in DB or send email via Laravel Mail (simple mailto for now)
Success: show inline "✓ Message sent! We'll reply within 24 hours." (NO alert())

Cross-link to sister site:
"Looking for farm products or field trips?"
→ "Visit Gundaling Farm →" gundalingfarm.com

===================================================================
SHARED LAYOUT (layout/app.blade.php)
===================================================================

HEAD:
- Tailwind + Vite (@vite(['resources/css/app.css', 'resources/js/app.js']))
- Google Fonts: Playfair Display + Nunito
- Alpine.js (defer)
- motion.dev (module, imported in app.js)
- hreflang links for EN/ID
- Schema.org JSON-LD (home page only):
{
  "@context": "https://schema.org",
  "@type": "Restaurant",
  "name": "Gundaling Farmstead",
  "url": "https://gundalingfarmstead.com",
  "address": { "@type": "PostalAddress",
    "streetAddress": "Jl. Jamin Ginting, Desa Jaranguda",
    "addressLocality": "Berastagi", "addressRegion": "Sumatera Utara",
    "postalCode": "22158", "addressCountry": "ID" },
  "geo": { "@type": "GeoCoordinates", "latitude": 3.1885, "longitude": 98.5092 },
  "telephone": "+6281234567890",
  "servesCuisine": ["Indonesian","Western","Karo","Farm to Table"],
  "openingHours": "Mo-Su 10:00-20:00"
}

NAVIGATION (Alpine.js):
x-data="{ scrolled: false, open: false, locale: '{{ app()->getLocale() }}',
  init() { window.addEventListener('scroll', () => this.scrolled = window.scrollY > 60) }}"

- Base: fixed top-0 w-full z-50 transition-all duration-300 py-4 px-6 lg:px-12
- Scrolled: :class="scrolled ? 'bg-farm-900/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
- Logo: /images/logos/Logo_GUNDALING_2-color_tall_on-white.png, h-12, filter brightness-0 invert (white on dark nav)
- Links: Home · Menu · Promo · About · Contact (with /id/ prefix when locale=id)
- Language switcher: [EN] [ID] toggle links
- Sister site link: "🌿 The Farm ↗" → gundalingfarm.com (opens new tab)
- CTA: "Reserve a Table" → gold pill, links to /reservations

FOOTER:
Walking mascot strip (80px):
- overflow-hidden relative
- <img src="/images/mascot/cow_mascot_apron.svg" class="walk-mascot absolute bottom-1.5 h-16">
- CSS: @keyframes walkAcross { from{left:-80px} to{left:100%} } 14s linear infinite
- motion.animate(".walk-mascot", {x: [-80, windowWidth+80]}, {duration:14, repeat:Infinity})
- 4px farm-green strip at bottom (grass)

Footer grid (lg:grid-cols-4):
- Brand: logo + tagline + Organic / Est.2005 / Open Kitchen badges
- Restaurant: menu, reservation, promo, about, contact links
- The Farm: "🌿 Visit Gundaling Farm ↗" (gundalingfarm.com)
- Find Us: address, hours, WA, email

Bottom bar: © 2025 Gundaling Farmstead · PT. Anugerah Alam Berastagi
Sister site links: pimsgundaling.com | gundalingfarm.com

WHATSAPP FLOAT:
x-data="{show:false}" x-init="setTimeout(()=>show=true,3000)"
x-show="show" x-transition (spring scale entrance)
- Fixed bottom-8 right-8, z-50
- #25D366 bg, 56px circle
- WhatsApp SVG icon (white)
- href="https://wa.me/6281234567890?text=Halo+Gundaling+Farmstead%2C+..."

===================================================================
SEO PER PAGE
===================================================================

Home:    "Gundaling Farmstead | Farm-to-Table Restaurant in Berastagi"
         desc: "Experience true farm-to-table dining at Gundaling Farmstead, Berastagi.
                Open kitchen, wood-fire pizza, artisan cheese & Karo cuisine. Est. 2005."
Menu:    "Menu | Gundaling Farmstead Restaurant Berastagi"
Reserv:  "Reserve a Table | Gundaling Farmstead Berastagi"
Promo:   "Special Offers | Gundaling Farmstead Berastagi"
About:   "Our Story | Gundaling Farmstead Est. 2005"
Contact: "Contact & Visit | Gundaling Farmstead Berastagi"

===================================================================
QUALITY CHECKLIST
===================================================================
[ ] /id/ prefix routes all work and return Indonesian content
[ ] Filament admin accessible at /admin (auth required)
[ ] BEO files stored in storage/app/private/beos/, NOT public disk
[ ] BEO download route protected by auth middleware
[ ] Menu sold-out toggle visible in both Filament and frontend (red overlay)
[ ] cow_mascot_apron.svg as <img>, never inline SVG, never path manipulation
[ ] Menu items in gelato/karo/tasteOfKaro categories fall back to placeholder card (no real photos yet)
[ ] motion.dev imported as ES module in app.js (not from CDN in Blade)
[ ] No Google Maps API key anywhere
[ ] No alert() — all form feedback via x-show success messages
[ ] WA links: wa.me/628... format with URL-encoded pre-fill text
[ ] Schema JSON-LD on home Blade only (@section('schema'))
[ ] hreflang tags on every page (both en and id)
[ ] prefers-reduced-motion: wrap all motion.dev calls in
    if(!window.matchMedia('(prefers-reduced-motion: reduce)').matches)
[ ] All images: alt text in English, loading="lazy" (except hero: eager)
[ ] Sister site links (gundalingfarm.com) open in _blank with rel="noopener"
[ ] Footer copyright: © 2025 Gundaling Farmstead — PT. Anugerah Alam Berastagi
[ ] Filament dashboard shows today's reservations and sold-out items