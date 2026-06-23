@extends('layouts.app')

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
    $first = $categories->first();
@endphp

<div
    x-data="{ active: '{{ $first?->slug }}', department: 'foods' }"
    class="pt-32 pb-20 px-6 lg:px-12 max-w-6xl mx-auto"
>
    <h1 class="font-display text-4xl text-farm-900 text-center mb-8">{{ __('menu.title') }}</h1>

    {{-- Foods / Drinks / Retail toggle --}}
    <div class="flex justify-center gap-2 mb-8">
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
                    @click="active = '{{ $cat->slug }}'"
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
        <section id="{{ $cat->slug }}" x-show="department === '{{ $cat->department }}'" class="mb-16">
            <h2 class="font-display text-2xl text-farm-600 mb-6">{{ $cat->localName() }}</h2>

            <div class="menu-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($cat->items as $item)
                    <div class="menu-item-card relative bg-white rounded-xl overflow-hidden shadow-sm">
                        <div class="relative aspect-video">
                            @if ($item->image)
                                <img src="/storage/{{ $item->image }}" alt="{{ $item->localName() }}" class="w-full h-full object-cover" loading="lazy">
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
                                <div class="absolute inset-0 bg-red-500/60 flex items-center justify-center">
                                    <span class="text-white font-bold tracking-widest uppercase text-sm">{{ __('common.sold_out') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="font-display text-farm-950">{{ $item->localName() }}</h3>
                            <p class="text-earth-600 text-sm mt-1">{{ $item->localDescription() }}</p>

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

@endsection
