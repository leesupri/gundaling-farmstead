@php
    $popupPromo = \App\Models\Promo::where('is_active', true)
        ->where('show_as_popup', true)
        ->where(function ($query) {
            $query->whereNull('valid_until')->orWhereDate('valid_until', '>=', today());
        })
        ->first();

    $popupPrefix = app()->getLocale() === 'id' ? 'id.' : '';
@endphp

@if ($popupPromo)
    <div
        x-data="{
            show: false,
            popupId: '{{ $popupPromo->id }}',
            reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
            init() {
                if (localStorage.getItem('popup_seen_id') !== this.popupId) {
                    setTimeout(() => { this.show = true }, 1500);
                }
            },
            animateOpen() {
                const card = this.$refs.card;
                const image = this.$refs.image;

                if (this.reduced) {
                    gsap.set(card, { opacity: 1, scale: 1, y: 0 });
                    if (image) gsap.set(image, { opacity: 1, scale: 1 });
                    return;
                }

                gsap.fromTo(card,
                    { opacity: 0, scale: 0.85, y: 20 },
                    { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.4)' }
                );

                if (image) {
                    gsap.fromTo(image,
                        { opacity: 0, scale: 1.15 },
                        { opacity: 1, scale: 1, duration: 1, ease: 'power3.out', delay: 0.15 }
                    );
                }
            },
            dismiss() {
                const card = this.$refs.card;

                if (this.reduced || !card) {
                    this.show = false;
                } else {
                    gsap.to(card, { opacity: 0, scale: 0.92, y: 10, duration: 0.25, ease: 'power2.in' });
                    this.show = false;
                }

                localStorage.setItem('popup_seen_id', this.popupId);
            },
        }"
        x-show="show"
        x-cloak
        x-transition.opacity.duration.300ms
        x-effect="show && $nextTick(() => animateOpen())"
        @keydown.escape.window="dismiss()"
        @click="dismiss()"
        class="fixed inset-0 z-60 flex items-center justify-center bg-black/60 backdrop-blur-md p-6 cursor-pointer"
    >
        <div
            x-ref="card"
            @click.stop
            style="opacity:0"
            class="relative bg-white rounded-2xl overflow-hidden shadow-2xl max-w-md w-full cursor-default"
        >
            <button
                @click="dismiss()"
                aria-label="Close"
                class="absolute top-3 right-3 z-10 bg-white/90 hover:bg-white rounded-full p-1.5 shadow transition-colors duration-200 cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-farm-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            @if ($popupPromo->image)
                <div class="overflow-hidden">
                    <img
                        x-ref="image"
                        src="{{ str_starts_with($popupPromo->image, '/') ? $popupPromo->image : '/storage/' . $popupPromo->image }}"
                        alt="{{ $popupPromo->localTitle() }}"
                        style="opacity:0"
                        class="w-full h-48 object-cover"
                    >
                </div>
            @endif

            <div class="p-6 text-center">
                <span class="inline-block bg-gold text-farm-950 text-xs font-bold px-3 py-1 rounded-full mb-3">
                    {{ $popupPromo->localTag() }}
                </span>
                <h3 class="font-display text-2xl text-farm-900 mb-2">{{ $popupPromo->localTitle() }}</h3>
                <p class="text-earth-700 mb-6">{{ $popupPromo->localDescription() }}</p>
                <div class="flex flex-col gap-3">
                    <a
                        href="{{ route($popupPrefix . 'promo') }}"
                        @click="dismiss()"
                        class="bg-farm-600 text-white font-bold px-6 py-3 rounded-full hover:bg-farm-500 transition-colors duration-200 cursor-pointer"
                    >
                        {{ __('common.view_offer') }}
                    </a>
                    <button @click="dismiss()" class="text-earth-500 text-sm hover:text-earth-700 transition-colors duration-200 cursor-pointer">
                        {{ __('common.maybe_later') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
