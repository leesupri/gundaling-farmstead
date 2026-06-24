@extends('layouts.app')

@section('schema')
@verbatim
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
  "telephone": "+6282162599980",
  "servesCuisine": ["Indonesian","Western","Karo","Farm to Table"],
  "openingHours": "Mo-Su 10:00-20:00"
}
@endverbatim
@endsection

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
@endphp

{{-- SCENE 0 — HERO --}}
<section id="hero" class="relative h-screen overflow-hidden">
    <img src="/images/hero/hero-farm.jpg" alt="Aerial view of Gundaling Farmstead with Mt. Sinabung in the background" class="hero-bg absolute inset-0 w-full h-full object-cover" loading="eager">
    <div class="absolute inset-0 bg-linear-to-b from-black/50 to-black/70"></div>

    <img src="/images/mascot/cow_mascot_apron.svg" alt="" class="mascot-idle absolute right-8 lg:right-24 bottom-24 h-64 lg:h-96 hidden md:block" loading="lazy">

    <div class="relative h-full flex items-center px-6 lg:px-12">
        <div class="max-w-xl">
            <div class="flex items-center gap-2 text-farm-200 font-sans mb-4">
                <span class="w-2 h-2 rounded-full bg-gold animate-pulse"></span>
                {{ __('home.eyebrow') }}
            </div>
            <h1 class="font-display text-white text-4xl sm:text-5xl lg:text-6xl leading-tight mb-6">
                {{ __('home.hero_title') }}
            </h1>
            <p class="text-farm-100 text-lg mb-8 max-w-md">
                {{ __('home.hero_subtitle') }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route($prefix . 'menu') }}" class="bg-farm-600 text-white px-6 py-3 rounded-full font-bold hover:bg-farm-500 transition-colors duration-200 cursor-pointer">
                    {{ __('common.view_menu') }} →
                </a>
                <a href="{{ route($prefix . 'reservations') }}" class="border-2 border-white text-white px-6 py-3 rounded-full font-bold hover:bg-white hover:text-farm-900 transition-colors duration-200 cursor-pointer">
                    {{ __('common.reserve_table') }}
                </a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </div>
</section>

{{-- SCENE 1 — THE FARM --}}
<section class="scene py-24 px-6 lg:px-12 bg-earth-50">
    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
        <div class="scene-img">
            <img src="/images/restaurant/story.jpg" alt="Gundaling Farm highland fields" class="rounded-3xl aspect-video object-cover w-full" loading="lazy">
        </div>
        <div class="scene-text">
            <span class="text-amber font-sans font-bold tracking-wide">{{ __('home.scene1_label') }}</span>
            <h2 class="font-display text-3xl lg:text-4xl text-farm-900 mt-2 mb-4">{{ __('home.scene1_title') }}</h2>
            <p class="text-earth-700 text-lg mb-6">{{ __('home.scene1_body') }}</p>
            <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="text-farm-600 font-bold hover:text-farm-500 cursor-pointer">
                → {{ __('home.scene1_link') }}
            </a>
        </div>
    </div>
</section>

{{-- SCENE 2 — THE DAIRY --}}
<section class="scene py-24 px-6 lg:px-12 bg-farm-50">
    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
        <div class="scene-text order-2 lg:order-1">
            <span class="text-amber font-sans font-bold tracking-wide">{{ __('home.scene2_label') }}</span>
            <h2 class="font-display text-3xl lg:text-4xl text-farm-900 mt-2 mb-4">{{ __('home.scene2_title') }}</h2>
            <p class="text-earth-700 text-lg mb-6">{{ __('home.scene2_body') }}</p>
            <div class="flex flex-wrap gap-2">
                @foreach (['Fresh Milk', 'Yogurt', 'Gelato', 'Cheese'] as $pill)
                    <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="bg-white border border-farm-300 text-farm-700 px-4 py-2 rounded-full text-sm hover:bg-farm-100 cursor-pointer">
                        {{ $pill }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="scene-img order-1 lg:order-2 flex justify-center">
            <img src="/images/mascot/cow_mascot_apron.png" alt="Gundaling Farmstead cow mascot" class="h-64" loading="lazy">
        </div>
    </div>
</section>

{{-- SCENE 3 — THE CHEESE CELLAR --}}
<section class="scene py-24 px-6 lg:px-12 bg-farm-950 relative overflow-hidden">
    <img src="/images/promo/promo-cheese.jpg" alt="" class="absolute inset-0 w-full h-full object-cover opacity-20" loading="lazy">
    <div class="relative max-w-6xl mx-auto text-center">
        <h2 class="font-display text-3xl lg:text-4xl text-white mb-12">{{ __('home.scene3_title') }}</h2>
        <div class="cheese-grid grid grid-cols-2 lg:grid-cols-5 gap-4 overflow-x-auto">
            @foreach ([
                ['name' => 'Mozzarella', 'age' => 'Fresh', 'note' => 'Soft, milky, mild'],
                ['name' => 'Gundaling Cheese', 'age' => '2 Years', 'note' => 'Semi-hard, nutty'],
                ['name' => 'Curd', 'age' => 'Fresh', 'note' => 'Light, tangy'],
                ['name' => 'Sinabung Tomme', 'age' => '5-10 Months', 'note' => 'Earthy, firm'],
                ['name' => 'Andaliman Tomme', 'age' => '3 Years', 'note' => 'Spiced, bold'],
            ] as $cheese)
                <div class="cheese-card bg-farm-900/80 rounded-2xl p-5 text-left">
                    <h3 class="font-display text-white text-lg mb-1">{{ $cheese['name'] }}</h3>
                    <p class="text-farm-300 text-xs mb-2">{{ $cheese['age'] }}</p>
                    <p class="text-farm-200 text-sm">{{ $cheese['note'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- SCENE 4 — THE KITCHEN --}}
<section class="scene relative py-32 px-6 lg:px-12 overflow-hidden">
    <img src="/images/hero/hero-farm.jpg" alt="Gundaling Farmstead open kitchen" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
    <div class="absolute inset-0 bg-linear-to-l from-farm-950/80 via-farm-950/40 to-transparent"></div>
    <div class="relative max-w-6xl mx-auto flex justify-end">
        <div class="scene-text max-w-md text-right">
            <span class="text-amber font-sans font-bold tracking-wide">{{ __('home.scene4_label') }}</span>
            <h2 class="font-display text-3xl lg:text-4xl text-white mt-2 mb-4">{{ __('home.scene4_title') }}</h2>
            <p class="text-farm-100 text-lg mb-6">{{ __('home.scene4_body') }}</p>
            <div class="flex flex-wrap gap-2 justify-end">
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm">Wood-fire</span>
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm">Open Kitchen</span>
                <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm">Farm Ingredients</span>
            </div>
        </div>
    </div>
</section>

{{-- SCENE 5 — TO YOUR TABLE --}}
<section class="scene py-24 px-6 lg:px-12 bg-earth-200 text-center">
    <img src="/images/mascot/cow_mascot_apron.svg" alt="" class="mascot-idle h-48 mx-auto mb-6" loading="lazy">
    <h2 class="font-display text-3xl lg:text-5xl text-farm-600 mb-4">{{ __('home.scene5_title') }}</h2>
    <p class="text-earth-700 text-lg max-w-2xl mx-auto mb-8">{{ __('home.scene5_body') }}</p>
    <div class="flex flex-wrap gap-4 justify-center mb-12">
        <a href="{{ route($prefix . 'reservations') }}" class="bg-farm-600 text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-farm-500 transition-colors duration-200 cursor-pointer">
            {{ __('common.reserve_table') }}
        </a>
        <a href="{{ route($prefix . 'menu') }}" class="border-2 border-farm-600 text-farm-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-farm-600 hover:text-white transition-colors duration-200 cursor-pointer">
            {{ __('common.view_menu') }}
        </a>
    </div>
    <div class="flex flex-wrap gap-8 justify-center text-earth-600 font-sans text-sm">
        <span>{{ __('home.stats_years') }}</span>
        <span>{{ __('home.stats_cheeses') }}</span>
        <span>{{ __('home.stats_kitchen') }}</span>
        <span>{{ __('home.stats_est') }}</span>
    </div>
</section>

@if ($featuredItems->isNotEmpty())
<section class="py-20 px-6 lg:px-12 bg-earth-50">
    <div class="max-w-6xl mx-auto">
        <h2 class="font-display text-3xl text-farm-900 mb-8 text-center">{{ __('home.featured_menu') }}</h2>
        <div class="menu-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredItems as $item)
                <div class="menu-item-card bg-white rounded-xl overflow-hidden shadow-sm">
                    @if ($item->image)
                        <img src="{{ str_starts_with($item->image, '/') ? $item->image : '/storage/' . $item->image }}" alt="{{ $item->localName() }}" class="aspect-video object-cover w-full" loading="lazy">
                    @else
                        <div class="aspect-video bg-linear-to-br from-farm-200 to-earth-200"></div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-display text-farm-950">{{ $item->localName() }}</h3>
                        @if ($item->price)
                            <p class="text-farm-600 font-bold mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if ($activePromos->isNotEmpty())
<section class="py-20 px-6 lg:px-12 bg-farm-600 text-center">
    <p class="font-display italic text-white text-2xl lg:text-3xl max-w-3xl mx-auto">
        “We did not plan to become a restaurant. The cows planned it for us.”
    </p>
</section>
@endif

<section class="py-16 px-6 lg:px-12 bg-earth-200 text-center">
    <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="text-farm-700 font-display text-xl hover:text-farm-500 cursor-pointer">
        {{ __('home.visit_sister') }} →
    </a>
</section>

@endsection
