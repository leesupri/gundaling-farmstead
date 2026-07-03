# Product

## Register

brand

## Users

Diners in and around Berastagi, North Sumatra: local families, domestic tourists visiting the Karo highlands, and weekend visitors from Medan. Bilingual audience (English default, Indonesian via /id/). They browse on mobile first, usually deciding where to eat today or reserving a table for a group/event. Secondary users: restaurant staff managing menu availability, promos, and reservations through the Filament admin.

## Product Purpose

Marketing and reservations site for Gundaling Farmstead (gundalingfarmstead.com), a farm-to-table restaurant owned by PT. Anugerah Alam Berastagi. The site tells the farm→milk→cheese→kitchen→table story, shows the full menu (199 items, Foods/Drinks/Retail with Hot/Cold/Whole/Slice price variants), surfaces promos, and converts visits into WhatsApp-confirmed reservations. Success = reservations made and menu browsed to a decision.

## Brand Personality

Warm, playful, rooted. A working highland farm that became a restaurant ("We did not plan to become a restaurant. The cows planned it for us."). Storytelling over selling; the Holstein cow mascot carries the playfulness, the wood-fire/volcanic-soil/artisan-cheese story carries the depth. Evening dining mood on the menu: warm dark greens, gold, real food photography glowing against dark surfaces.

## Anti-references

- Generic restaurant templates: uniform white card grids, stock-photo sameness, interchangeable-with-any-café look.
- Busy, everything-at-once heroes. One dominant idea per fold.
- Hard visual seams between sections (e.g. near-black hero cutting to pale cream body with no transition) — the page must read as one designed world.
- Corporate/minimal coldness; this is a family farm, not a fine-dining flex.

## Design Principles

1. **One world per page.** Every section of a page shares one atmosphere; transitions are designed, never abrupt.
2. **The food is the design.** Real photography from the farm and kitchen leads; decoration (spice botanicals, mascot) stays behind it, as texture.
3. **Story before sell.** Sections narrate farm-to-table; CTAs ride on the story, they don't interrupt it.
4. **Playful, not childish.** The mascot and motion add warmth in small doses; typography and color stay grown-up.
5. **Both languages are first-class.** Every visible string localized EN/ID; nothing ships English-only.

## Accessibility & Inclusion

- WCAG AA contrast (≥4.5:1 body, ≥3:1 large text) — especially disciplined on dark surfaces.
- Every animation respects `prefers-reduced-motion` (gsap.matchMedia gates all motion).
- Carousels/interactive widgets: keyboard navigable, ARIA roles/labels, localized labels.
- Images: meaningful alt text; decorative images `alt=""` + `aria-hidden`.
