@extends('layouts.app')

@section('content')

@php
    $featured = $promos->first();
    $rest = $promos->skip(1);
@endphp

<div class="pt-32 pb-20 px-6 lg:px-12 max-w-6xl mx-auto">

    @if ($featured)
        <div class="grid md:grid-cols-2 gap-0 rounded-2xl overflow-hidden bg-white shadow-sm mb-12">
            <img
                src="{{ $featured->image ? '/storage/' . $featured->image : '/images/promo/promo-cheese.jpg' }}"
                alt="{{ $featured->localTitle() }}"
                class="w-full h-64 md:h-full object-cover"
                loading="eager"
            >
            <div class="p-8 flex flex-col justify-center">
                <span class="inline-block bg-gold text-farm-950 text-xs font-bold px-3 py-1 rounded-full mb-3 w-fit">
                    {{ $featured->localTag() }}
                </span>
                <h2 class="font-display text-2xl text-farm-900 mb-2">{{ $featured->localTitle() }}</h2>
                <p class="text-earth-700">{{ $featured->localDescription() }}</p>
                @if ($featured->valid_until)
                    <p class="text-earth-500 text-sm mt-3">Valid until {{ $featured->valid_until->format('d M Y') }}</p>
                @endif
            </div>
        </div>
    @endif

    <div class="promo-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($rest as $promo)
            <div class="promo-card bg-white rounded-xl overflow-hidden shadow-sm">
                <img
                    src="{{ $promo->image ? '/storage/' . $promo->image : '/images/promo/promo-cheese.jpg' }}"
                    alt="{{ $promo->localTitle() }}"
                    class="aspect-video object-cover w-full"
                    loading="lazy"
                >
                <div class="p-5">
                    <span class="inline-block bg-farm-100 text-farm-700 text-xs font-bold px-3 py-1 rounded-full mb-2">
                        {{ $promo->localTag() }}
                    </span>
                    <h3 class="font-display text-farm-900">{{ $promo->localTitle() }}</h3>
                    <p class="text-earth-600 text-sm mt-1">{{ $promo->localDescription() }}</p>
                    @if ($promo->valid_until)
                        <p class="text-earth-500 text-xs mt-3">Valid until {{ $promo->valid_until->format('d M Y') }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="bg-earth-200 py-10 px-6 text-center">
    <p class="text-earth-700 mb-4">{{ __('promo.early_access') }}</p>
    <a
        href="https://wa.me/6281234567890"
        target="_blank" rel="noopener"
        class="inline-block bg-farm-600 text-white font-bold px-6 py-3 rounded-full hover:bg-farm-500 transition-colors duration-200 cursor-pointer"
    >
        {{ __('common.whatsapp_us') }}
    </a>
</div>

@endsection
