@php
    $isFarmstead = $review['brand'] === 'farmstead';
    $reviewUrl = $isFarmstead
        ? 'https://g.page/r/9904571155086556270/review'
        : 'https://g.page/r/2252842551209686390/review';
@endphp

<div class="review-card rounded-xl p-6 mb-4 border border-earth-100/8 {{ $isFarmstead ? 'bg-earth-800/75' : 'bg-farm-800/75' }}">
    {{-- Brand badge --}}
    <span class="inline-flex text-[9px] font-bold uppercase tracking-wider px-2 py-1 rounded-full mb-4 border {{ $isFarmstead ? 'bg-amber/15 text-amber border-amber/30' : 'bg-farm-400/15 text-farm-300 border-farm-400/30' }}">
        {{ $isFarmstead ? 'Gundaling Farmstead' : 'Gundaling Farm' }}
    </span>

    {{-- Stars --}}
    <div class="flex gap-0.5 mb-3 text-gold text-xs" aria-label="5/5">★★★★★</div>

    {{-- Review text --}}
    <p class="text-[13.5px] text-earth-100/80 leading-relaxed italic mb-5">
        “{{ $review['text'] }}”
    </p>

    <hr class="border-earth-100/6 mb-3.5">

    {{-- Reviewer --}}
    <p class="text-[13px] font-bold text-earth-100">{{ $review['name'] }}</p>
    <p class="text-[11px] mt-0.5 {{ $isFarmstead ? 'text-amber' : 'text-farm-300' }}">{{ $review['role'] }}</p>
    <p class="text-[11px] text-earth-100/40 mt-0.5">{{ $review['origin'] }}</p>

    {{-- Google badge --}}
    <a href="{{ $reviewUrl }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 mt-3 text-[10px] text-earth-100/40 hover:text-earth-100/70 transition-colors duration-200 cursor-pointer">
        <svg width="11" height="11" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.4H12v4.5h6.5a5.6 5.6 0 0 1-2.4 3.7v3h3.9c2.3-2.1 3.5-5.2 3.5-8.8z"/>
            <path fill="#34A853" d="M12 24c3.2 0 6-1.1 7.9-2.9l-3.9-3a7.2 7.2 0 0 1-10.8-3.8H1.3v3.1A12 12 0 0 0 12 24z"/>
            <path fill="#FBBC05" d="M5.2 14.3a7.2 7.2 0 0 1 0-4.6V6.6H1.3a12 12 0 0 0 0 10.8l3.9-3.1z"/>
            <path fill="#EA4335" d="M12 4.8c1.8 0 3.3.6 4.6 1.8L20 3.2A12 12 0 0 0 1.3 6.6l3.9 3.1A7.2 7.2 0 0 1 12 4.8z"/>
        </svg>
        Google Review
    </a>
</div>
