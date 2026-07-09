@php
    // Recommended mix — col 1: warm-dominant, col 2: green-dominant, col 3: offset warm.
    $farmstead = $reviews->where('brand', 'farmstead')->values();
    $farm = $reviews->where('brand', 'farm')->values();

    $columns = collect([
        [$farmstead->get(0), $farm->get(0), $farmstead->get(1)],
        [$farm->get(1), $farmstead->get(2), $farm->get(2)],
        [$farmstead->get(3), $farm->get(3), $farmstead->get(4)],
    ])->map(fn ($column) => collect($column)->filter()->values());
@endphp

@if ($columns->flatten(1)->isNotEmpty())
<section class="reviews-section py-24 px-6 lg:px-12 overflow-hidden bg-farm-950">

    {{-- Header --}}
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start gap-8 mb-14">
        <div>
            <p class="text-[10px] font-bold uppercase tracking-[0.4em] text-amber mb-3">
                ★ {{ __('home.reviews_eyebrow') }}
            </p>
            <h2 class="font-display text-4xl lg:text-5xl text-earth-100 leading-tight">
                {{ __('home.reviews_title_1') }}<br>
                <em class="italic font-normal text-earth-100/50">{{ __('home.reviews_title_2') }}</em>
            </h2>
        </div>
        <div>
            <div class="flex gap-2 mb-4 flex-wrap">
                <span class="text-[9px] font-bold uppercase tracking-wide px-3 py-1 rounded-full bg-amber/15 text-amber border border-amber/30">
                    Gundaling Farmstead
                </span>
                <span class="text-[9px] font-bold uppercase tracking-wide px-3 py-1 rounded-full bg-farm-400/15 text-farm-300 border border-farm-400/30">
                    Gundaling Farm
                </span>
            </div>
            <p class="text-sm text-earth-100/50 leading-relaxed max-w-xs">
                {{ __('home.reviews_sub') }}
            </p>
        </div>
    </div>

    {{-- Auto-scrolling columns; hover anywhere on the section pauses them --}}
    <div class="reviews-columns max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 h-120 lg:h-160 overflow-hidden">
        @foreach ($columns as $i => $column)
            <div @class(['overflow-hidden', 'hidden md:block' => $i === 1, 'hidden lg:block' => $i === 2])>
                <div
                    class="{{ $i === 1 ? 'reviews-col-down' : 'reviews-col-up' }} flex flex-col"
                    @if ($i === 2) style="animation-duration: 44s; animation-delay: 3s;" @endif
                >
                    @foreach ($column as $review)
                        @include('partials.review-card', ['review' => $review])
                    @endforeach
                    {{-- Identical duplicate set so translateY(-50%) loops seamlessly --}}
                    <div aria-hidden="true" class="contents">
                        @foreach ($column as $review)
                            @include('partials.review-card', ['review' => $review])
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif
