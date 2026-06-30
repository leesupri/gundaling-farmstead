@extends('layouts.app')

@section('content')

@php
    $featured = $promos->first();
    $rest = $promos->skip(1);
@endphp

<section class="relative h-[40vh] overflow-hidden">
    <img src="/images/hero/Resto.jpg" alt="Stone entrance path leading to Gundaling Farmstead" class="hero-bg absolute inset-0 w-full h-full object-cover" loading="eager">
    <div class="absolute inset-0 bg-linear-to-b from-black/40 to-black/70"></div>
    <div class="relative h-full flex items-center justify-center text-center px-6">
        <div class="hero-content-fade">
            <h1 class="font-display text-white text-3xl lg:text-5xl mb-2">{{ __('promo.title') }}</h1>
            <p class="text-farm-100">{{ __('promo.subtitle') }}</p>
        </div>
    </div>
</section>

<div x-data="{ lightbox: null }" @keydown.escape.window="lightbox = null" class="pt-16 pb-20 px-6 lg:px-12 max-w-6xl mx-auto">

    @if ($featured)
        @php $featuredSrc = $featured->image ? '/storage/' . $featured->image : '/images/promo/promo-cheese.jpg'; @endphp
        <div class="grid md:grid-cols-2 gap-0 rounded-2xl overflow-hidden bg-white shadow-sm mb-12">
            <img
                src="{{ $featuredSrc }}"
                alt="{{ $featured->localTitle() }}"
                class="w-full h-64 md:h-full object-cover cursor-pointer"
                loading="eager"
                @click="lightbox = '{{ $featuredSrc }}'"
            >
            <div class="p-8 flex flex-col justify-center">
                <span class="inline-block bg-gold text-farm-950 text-xs font-bold px-3 py-1 rounded-full mb-3 w-fit">
                    {{ $featured->localTag() }}
                </span>
                <h2 class="font-display text-2xl text-farm-900 mb-2">{{ $featured->localTitle() }}</h2>
                <p class="text-earth-700">{{ $featured->localDescription() }}</p>
                @if ($featured->valid_until)
                    <p class="text-earth-500 text-sm mt-3">{{ __('promo.valid_until', ['date' => $featured->valid_until->format('d M Y')]) }}</p>
                @endif
            </div>
        </div>
    @endif

    <div class="promo-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($rest as $promo)
            @php $promoSrc = $promo->image ? '/storage/' . $promo->image : '/images/promo/promo-cheese.jpg'; @endphp
            <div class="promo-card bg-white rounded-xl overflow-hidden shadow-sm">
                <img
                    src="{{ $promoSrc }}"
                    alt="{{ $promo->localTitle() }}"
                    class="aspect-video object-cover w-full cursor-pointer"
                    loading="lazy"
                    @click="lightbox = '{{ $promoSrc }}'"
                >
                <div class="p-5">
                    <span class="inline-block bg-farm-100 text-farm-700 text-xs font-bold px-3 py-1 rounded-full mb-2">
                        {{ $promo->localTag() }}
                    </span>
                    <h3 class="font-display text-farm-900">{{ $promo->localTitle() }}</h3>
                    <p class="text-earth-600 text-sm mt-1">{{ $promo->localDescription() }}</p>
                    @if ($promo->valid_until)
                        <p class="text-earth-500 text-xs mt-3">{{ __('promo.valid_until', ['date' => $promo->valid_until->format('d M Y')]) }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Lightbox --}}
    <div
        x-show="lightbox"
        x-cloak
        x-transition.opacity.duration.200ms
        @click="lightbox = null"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-md p-6 cursor-pointer"
    >
        <button
            @click="lightbox = null"
            aria-label="Close image"
            class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors duration-200 cursor-pointer"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img
            :src="lightbox"
            alt=""
            @click.stop
            class="max-h-[85vh] max-w-full rounded-2xl shadow-2xl cursor-default"
        >
    </div>
</div>

<div class="bg-earth-200 py-10 px-6 text-center">
    <p class="text-earth-700 mb-4">{{ __('promo.early_access') }}</p>
    <a
        href="https://wa.me/6282162599980"
        target="_blank" rel="noopener"
        class="inline-block bg-farm-600 text-white font-bold px-6 py-3 rounded-full hover:bg-farm-500 transition-colors duration-200 cursor-pointer"
    >
        {{ __('common.whatsapp_us') }}
    </a>
</div>

@endsection
