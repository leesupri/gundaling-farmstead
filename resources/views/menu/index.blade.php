@extends('layouts.app')

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
    $first = $categories->first();
@endphp

{{-- ── Spice Parallax Hero ─────────────────────────────────────────────────── --}}
<section class="menu-hero relative overflow-hidden bg-farm-950" style="min-height:52vh">

    {{-- Back layer – slowest on scroll (-15%) – large background botanicals --}}
    <div class="hero-spice-back absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/lemongrass.svg') }}"
             alt="" aria-hidden="true"
             class="absolute -left-12 -top-10 h-112 opacity-20 -rotate-12">
        <img src="{{ asset('images/spices/galangal.svg') }}"
             alt="" aria-hidden="true"
             class="absolute -right-8 -bottom-16 h-80 opacity-15 rotate-[8deg]">
    </div>

    {{-- Mid layer – medium speed (-30%) – accent botanicals --}}
    <div class="hero-spice-mid absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/turmeric.svg') }}"
             alt="" aria-hidden="true"
             class="absolute right-20 -top-6 h-52 opacity-30 rotate-14">
        <img src="{{ asset('images/spices/kecombrang.svg') }}"
             alt="" aria-hidden="true"
             class="absolute left-1/4 -bottom-8 h-60 opacity-25 -rotate-6">
        <img src="{{ asset('images/spices/Asam-Gelugur.svg') }}"
             alt="" aria-hidden="true"
             class="absolute right-[38%] top-10 h-40 opacity-35 rotate-22">
    </div>

    {{-- Front layer – fastest (-50%) – small foreground accents --}}
    <div class="hero-spice-front absolute inset-0 pointer-events-none select-none">
        <img src="{{ asset('images/spices/andaliman.svg') }}"
             alt="" aria-hidden="true"
             class="absolute left-16 bottom-8 h-28 opacity-55 -rotate-10">
        <img src="{{ asset('images/spices/cikala.svg') }}"
             alt="" aria-hidden="true"
             class="absolute right-28 top-14 h-32 opacity-50 rotate-[5deg]">
    </div>

    {{-- Gradient vignette so edges don't look cut off --}}
    <div class="absolute inset-0 bg-radial-[ellipse_80%_80%_at_50%_50%] from-transparent to-farm-950/70 pointer-events-none"></div>

    {{-- Bottom fade into page body --}}
    <div class="absolute bottom-0 left-0 right-0 h-20 bg-linear-to-t from-earth-50 to-transparent pointer-events-none"></div>

    {{-- Hero text --}}
    <div class="relative z-10 text-center pt-40 pb-28 px-6">
        <p class="hero-content-fade font-sans text-gold text-xs tracking-[0.28em] uppercase mb-5">
            {{ __('menu.hero_eyebrow') }}
        </p>
        <h1 class="hero-content-fade font-display text-white text-5xl md:text-6xl lg:text-7xl leading-none">
            {{ __('menu.title') }}
        </h1>
        <p class="hero-content-fade font-sans text-farm-300 text-base lg:text-lg mt-5 max-w-md mx-auto">
            {{ __('menu.hero_sub') }}
        </p>
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
        mounted: false,
        init() {
            this.$nextTick(() => { this.mounted = true });
        },
        scrollToSection(slug) {
            this.active = slug;
            gsap.to(window, { duration: 0.7, ease: 'power2.inOut', scrollTo: { y: '#' + slug, offsetY: 140 } });
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
    {{-- Foods / Drinks / Retail toggle --}}
    <div class="flex justify-center gap-2 pt-8 mb-8">
        @foreach (['foods' => __('menu.foods'), 'drinks' => __('menu.drinks'), 'retail' => __('menu.retail')] as $dept => $label)
            <button
                @click="department = '{{ $dept }}'"
                :class="department === '{{ $dept }}' ? 'bg-farm-600 text-white' : 'bg-farm-50 text-farm-700'"
                class="px-6 py-2 rounded-full font-bold transition-colors duration-200 cursor-pointer"
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Sticky category nav --}}
    <div class="sticky top-20 z-30 bg-earth-50/95 backdrop-blur-md py-3 -mx-6 px-6 lg:-mx-12 lg:px-12 mb-10 overflow-x-auto">
        <div class="flex gap-2 min-w-max">
            @foreach ($categories as $cat)
                <a
                    href="#{{ $cat->slug }}"
                    @click.prevent="scrollToSection('{{ $cat->slug }}')"
                    x-show="department === '{{ $cat->department }}'"
                    :class="active === '{{ $cat->slug }}' ? 'bg-farm-600 text-white' : 'bg-white text-farm-700'"
                    class="px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap transition-colors duration-200 cursor-pointer"
                >
                    {{ $cat->localName() }}
                </a>
            @endforeach
        </div>
    </div>

    @foreach ($categories as $cat)
        <section
            id="{{ $cat->slug }}"
            x-show="department === '{{ $cat->department }}'"
            x-effect="department === '{{ $cat->department }}' && animateSectionIn($el)"
            class="mb-16"
        >
            <h2 class="font-display text-2xl text-farm-600 mb-6">{{ $cat->localName() }}</h2>

            <div class="menu-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cat->items as $item)
                    <div class="menu-item-card relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300">
                        <div class="relative aspect-video overflow-hidden">
                            @if ($item->image)
                                <img src="{{ str_starts_with($item->image, '/') ? $item->image : '/storage/' . $item->image }}" alt="{{ $item->localName() }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full bg-linear-to-br from-farm-200 to-earth-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-farm-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                <div class="absolute inset-0 bg-red-600/65 flex items-center justify-center">
                                    <span class="text-white font-bold tracking-widest uppercase text-sm">{{ __('common.sold_out') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-display text-farm-950">{{ $item->localName() }}</h3>
                            <p class="text-earth-600 text-sm mt-1 line-clamp-2">{{ $item->localDescription() }}</p>

                            <div class="flex flex-wrap gap-3 mt-3">
                                @forelse ($item->activePrices() as $label => $value)
                                    <span class="text-farm-600 font-bold text-sm">
                                        @if ($label !== 'Price'){{ $label }}: @endif
                                        Rp {{ number_format($value, 0, ',', '.') }}
                                    </span>
                                @empty
                                    <span class="text-earth-400 text-sm">{{ __('common.sold_out') }}</span>
                                @endforelse
                            </div>

                            @if ($item->notes)
                                <p class="text-earth-500 text-xs mt-2 italic">{{ $item->notes }}</p>
                            @endif

                            @if ($item->is_featured)
                                <span class="inline-flex items-center gap-1 mt-3 text-xs text-farm-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c-4-3-7-6.5-7-10.5A7 7 0 0112 3a7 7 0 017 7.5C19 14.5 16 18 12 21z" />
                                    </svg>
                                    {{ __('common.from_our_farm') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-earth-500 col-span-full">—</p>
                @endforelse
            </div>
        </section>
    @endforeach
</div>

</section>

@endsection
