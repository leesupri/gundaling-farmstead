@extends('layouts.app')

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
    $first = $categories->first();

    // Carousel media + accent color per slide; label/title/desc come from lang files.
    $heroMedia = [
        ['img' => 'aab_menu-2.jpg', 'color' => '#F5C542'], // gold — warm cheese tones
        ['img' => 'aab_menu-4.jpg', 'color' => '#E8943A'], // amber
        ['img' => 'aab_menu-3.jpg', 'color' => '#6BA44E'], // farm green — pesto
        ['img' => 'aab_menu-1.jpg', 'color' => '#D4520E'], // fire — earthy Karo tones
        ['img' => 'aab_menu-6.jpg', 'color' => '#C084B8'], // soft pink — flower/dessert
        ['img' => 'aab_menu-5.jpg', 'color' => '#A8876E'], // tan — aged cheese
        ['img' => 'aab_menu-7.jpg', 'color' => '#765F52'], // warm brown
    ];
    $heroSlides = array_map(
        fn ($media, $text) => array_merge($media, $text),
        $heroMedia,
        __('menu.hero_slides'),
    );
@endphp

{{-- ── Menu Hero: 3D coverflow carousel above the spice parallax ───────────── --}}
<section id="menu-hero" class="menu-hero" aria-label="{{ __('menu.slides_aria') }}">

    {{-- Quiet spice depth: one botanical per layer, low opacity, parallax only --}}
    <div class="hero-spice-back absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/lemongrass.svg') }}"
             alt="" aria-hidden="true"
             class="absolute -left-12 -top-10 h-112 opacity-15 -rotate-12">
    </div>

    <div class="hero-spice-mid absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/kecombrang.svg') }}"
             alt="" aria-hidden="true"
             class="absolute left-1/4 -bottom-8 h-60 opacity-20 -rotate-6">
    </div>

    <div class="hero-spice-front absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/andaliman.svg') }}"
             alt="" aria-hidden="true"
             class="absolute left-16 bottom-8 h-28 opacity-35 -rotate-10">
    </div>

    {{-- Dark radial overlay so text always reads over the spice layers --}}
    <div class="menu-hero-overlay"></div>


    {{-- ── HEADLINE (left, reacts to slide changes) ── --}}
    <div class="menu-hero-text" aria-live="polite">
        <p class="menu-hero-eyebrow">
            <span class="eyebrow-dot"></span>
            {{ __('menu.hero_eyebrow') }}
        </p>
        <h1 class="menu-hero-title">{{ __('menu.title') }}</h1>
        <p class="menu-hero-sub">{{ __('menu.hero_sub') }}</p>

        {{-- Dynamic slide label that changes with active card --}}
        <div class="menu-slide-label-wrap">
            <span class="menu-slide-label" id="slideLabel">{{ $heroSlides[0]['label'] }}</span>
        </div>

        {{-- Progress dots --}}
        <div class="carousel-dots" role="tablist" aria-label="{{ __('menu.slides_aria') }}">
            @foreach ($heroSlides as $i => $slide)
                <button
                    class="carousel-dot {{ $i === 0 ? 'active' : '' }}"
                    role="tab"
                    aria-label="{{ __('menu.slide_n', ['n' => $i + 1]) }}"
                    data-index="{{ $i }}"
                ></button>
            @endforeach
        </div>
    </div>

    {{-- ── 3D CAROUSEL STAGE ── --}}
    <div class="carousel-stage-wrap">
        <div class="carousel-stage" id="carouselStage">
            @foreach ($heroSlides as $i => $slide)
                <div
                    class="carousel-card {{ $i === 0 ? 'is-active' : '' }}"
                    data-index="{{ $i }}"
                    data-color="{{ $slide['color'] }}"
                    data-label="{{ $slide['label'] }}"
                    role="tab"
                    tabindex="{{ $i === 0 ? '0' : '-1' }}"
                    aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                    aria-label="{{ $slide['label'] }}: {{ $slide['title'] }}"
                >
                    <img
                        src="{{ asset('images/menu/hero/' . $slide['img']) }}"
                        alt="{{ $slide['title'] }}"
                        class="carousel-card-img"
                        loading="{{ $i < 3 ? 'eager' : 'lazy' }}"
                        draggable="false"
                        width="640"
                        height="480"
                    >

                    {{-- Colored accent glow matching dish palette --}}
                    <div class="card-glow" style="--glow-color: {{ $slide['color'] }}"></div>
                </div>
            @endforeach
        </div>

        {{-- Prev / Next arrows --}}
        <button class="carousel-arrow carousel-prev" id="carouselPrev" aria-label="{{ __('menu.prev_dish') }}">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M12 4L6 10L12 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button class="carousel-arrow carousel-next" id="carouselNext" aria-label="{{ __('menu.next_dish') }}">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M8 4L14 10L8 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</section>

{{-- ── Menu Section: spice stage + content ─────────────────────────────────── --}}
<section id="menu">

    {{-- Karo spice parallax stage — decorative depth layers behind the menu grid --}}
    <div class="menu-spice-stage" aria-hidden="true">

        {{-- LAYER 1: BACK — green tint, slow --}}
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

        {{-- LAYER 2: MID — earth brown tint, medium --}}
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

        {{-- LAYER 3: FRONT — gold tint, fastest --}}
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

<div
    x-data="{
        active: '{{ $first?->slug }}',
        department: 'foods',
        firstSlugs: {{ Js::from($categories->groupBy('department')->map(fn ($group) => $group->first()->slug)) }},
        mounted: false,
        init() {
            this.$nextTick(() => { this.mounted = true });
        },
        switchDepartment(dept) {
            if (this.department === dept) return;
            this.department = dept;
            const slug = this.firstSlugs[dept];
            if (slug) {
                this.$nextTick(() => this.scrollToSection(slug));
            }
        },
        scrollToSection(slug) {
            this.active = slug;
            gsap.to(window, { duration: 0.7, ease: 'power2.inOut', scrollTo: { y: '#' + slug, offsetY: 220 } });
        },
        animateSectionIn(el) {
            if (!this.mounted || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                return;
            }
            gsap.fromTo(el, { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' });
        },
    }"
    class="menu-content pb-20 px-6 lg:px-12 max-w-6xl mx-auto"
>
    {{-- Sticky wayfinding bar: department + categories pinned below the header --}}
    <div class="sticky top-20 z-30 bg-farm-950/90 backdrop-blur-md -mx-6 px-6 lg:-mx-12 lg:px-12 mb-10 pt-4 border-b border-white/5">
        {{-- Foods / Drinks / Retail --}}
        <div class="flex justify-center gap-2">
            @foreach (['foods' => __('menu.foods'), 'drinks' => __('menu.drinks'), 'retail' => __('menu.retail')] as $dept => $label)
                <button
                    @click="switchDepartment('{{ $dept }}')"
                    :class="department === '{{ $dept }}'
                        ? 'bg-gold text-farm-950 hover:bg-amber'
                        : 'bg-white/5 text-farm-100 border border-white/10 hover:bg-white/15 hover:text-white hover:border-gold/40'"
                    class="px-5 py-1.5 rounded-full text-sm font-bold transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- Categories of the active department --}}
        <div class="py-3 overflow-x-auto">
            <div class="flex gap-2 w-max mx-auto">
                @foreach ($categories as $cat)
                    <a
                        href="#{{ $cat->slug }}"
                        @click.prevent="scrollToSection('{{ $cat->slug }}')"
                        x-show="department === '{{ $cat->department }}'"
                        :class="active === '{{ $cat->slug }}'
                            ? 'bg-gold text-farm-950 hover:bg-amber'
                            : 'bg-white/5 text-farm-100 hover:bg-white/15 hover:text-white'"
                        class="px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-200 hover:-translate-y-0.5 cursor-pointer"
                    >
                        {{ $cat->localName() }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @foreach ($categories as $cat)
        <section
            id="{{ $cat->slug }}"
            x-show="department === '{{ $cat->department }}'"
            x-effect="department === '{{ $cat->department }}' && animateSectionIn($el)"
            x-intersect:enter.margin.-45%.0px.-45%.0px="active = '{{ $cat->slug }}'"
            class="mb-16 scroll-mt-52"
        >
            <h2 class="font-display text-2xl text-gold mb-6 flex items-center gap-4">
                {{ $cat->localName() }}
                <span class="flex-1 h-px bg-white/10" aria-hidden="true"></span>
            </h2>

            <div class="menu-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cat->items as $item)
                    @php
                        $description = $item->localDescription();
                        $isLongDescription = $description && mb_strlen($description) > 80;
                    @endphp
                    <div
                        x-data="{ expanded: false }"
                        class="menu-item-card relative bg-white/4 border border-white/8 rounded-xl overflow-hidden hover:border-gold/40 transition-colors duration-300"
                    >
                        <div class="relative aspect-video overflow-hidden">
                            @if ($item->image)
                                <img src="{{ str_starts_with($item->image, '/') ? $item->image : '/storage/' . $item->image }}" alt="{{ $item->localName() }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full bg-linear-to-br from-farm-800/60 to-farm-950 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-farm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7l9-4 9 4-9 4-9-4zm0 0v10l9 4 9-4V7" />
                                    </svg>
                                </div>
                            @endif

                            @if ($item->badge)
                                <span class="absolute top-3 right-3 bg-gold text-farm-950 text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $item->badge }}
                                </span>
                            @endif

                            @if ($item->is_sold_out)
                                <div class="absolute inset-0 bg-farm-950/75 flex items-center justify-center">
                                    <span class="bg-fire text-white font-bold tracking-widest uppercase text-xs px-4 py-1.5 rounded-full">{{ __('common.sold_out') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-display text-earth-200 wrap-break-word">{{ $item->localName() }}</h3>

                            @if ($description)
                                <div class="menu-item-desc-wrap" :class="expanded ? 'is-expanded' : ''">
                                    <p
                                        class="text-farm-200 text-sm mt-1 wrap-break-word"
                                        :class="expanded ? 'line-clamp-none' : 'line-clamp-2'"
                                    >
                                        {{ $description }}
                                    </p>
                                </div>

                                @if ($isLongDescription)
                                    <button
                                        type="button"
                                        @click="expanded = !expanded"
                                        :aria-expanded="expanded.toString()"
                                        class="inline-flex items-center gap-1 mt-1 text-xs font-bold text-gold hover:text-amber transition-colors duration-200 cursor-pointer"
                                    >
                                        <span x-text="expanded ? '{{ __('common.show_less') }}' : '{{ __('common.show_more') }}'"></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                @endif
                            @endif

                            <div class="flex flex-wrap gap-3 mt-3">
                                @forelse ($item->activePrices() as $label => $value)
                                    <span class="text-gold font-bold text-sm">
                                        @if ($label !== 'Price'){{ $label }}: @endif
                                        Rp {{ number_format($value, 0, ',', '.') }}
                                    </span>
                                @empty
                                    <span class="text-earth-400 text-sm">{{ __('common.sold_out') }}</span>
                                @endforelse
                            </div>

                            @if ($item->notes)
                                <p class="text-earth-400 text-xs mt-2 italic">{{ $item->notes }}</p>
                            @endif

                            @if ($item->is_featured)
                                <span class="inline-flex items-center gap-1 mt-3 text-xs text-farm-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c-4-3-7-6.5-7-10.5A7 7 0 0112 3a7 7 0 017 7.5C19 14.5 16 18 12 21z" />
                                    </svg>
                                    {{ __('common.from_our_farm') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-farm-300 col-span-full">—</p>
                @endforelse
            </div>
        </section>
    @endforeach
</div>

</section>

@endsection
