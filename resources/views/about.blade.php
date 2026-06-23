@extends('layouts.app')

@section('content')

<section class="relative h-[60vh] overflow-hidden">
    <img src="/images/restaurant/story.jpg" alt="Gundaling Farmstead restaurant interior" class="absolute inset-0 w-full h-full object-cover" loading="eager">
    <div class="absolute inset-0 bg-linear-to-b from-black/40 to-black/70"></div>
    <div class="relative h-full flex items-center justify-center">
        <h1 class="font-display text-white text-4xl lg:text-6xl">{{ app()->getLocale() === 'id' ? 'Kisah Kami' : 'Our Story' }}</h1>
    </div>
</section>

<section class="py-20 px-6 lg:px-12 max-w-4xl mx-auto">
    <div class="relative">
        <div class="timeline-connector absolute left-0 right-0 top-4 h-0.5 bg-farm-300 hidden lg:block"></div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @foreach ([
                ['year' => '2005', 'text' => 'Farm established. "The cows planned it for us."'],
                ['year' => '2018', 'text' => 'Cheese production begins. First Tomme aged.'],
                ['year' => '2019', 'text' => 'Restaurant opens. Open kitchen, farm-to-table.'],
                ['year' => 'Now', 'text' => 'Working farm + restaurant + agritourism destination.'],
            ] as $stop)
                <div class="relative pl-6 lg:pl-0 lg:text-center">
                    <span class="absolute lg:relative lg:block left-0 lg:mx-auto w-3 h-3 rounded-full bg-farm-600 top-2 lg:top-0 lg:mb-4"></span>
                    <h3 class="font-display text-xl text-farm-600">{{ $stop['year'] }}</h3>
                    <p class="text-earth-700 text-sm mt-1">{{ $stop['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 px-6 lg:px-12 max-w-3xl mx-auto space-y-12">
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">A Journey That Started with Fertilizer</h2>
        <p class="text-earth-700 leading-relaxed">
            Andreas never set out to open a restaurant. What began as a small farming operation in the highlands of
            Berastagi — cool air, volcanic soil, and a herd of dairy cows — slowly grew into something larger than
            he imagined. The farm came first. Everything else followed from it.
        </p>
    </div>
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">From Milk to Cheese</h2>
        <p class="text-earth-700 leading-relaxed">
            Daily milking, on-site pasteurisation, and years of trial and error turned fresh milk into five artisan
            cheeses — each aged and crafted by hand, true to the Karo highlands they come from.
        </p>
    </div>
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">Why Farm to Table Matters to Us</h2>
        <p class="text-earth-700 leading-relaxed">
            Every dish that leaves our open kitchen carries the story of the field it came from. We believe
            ingredients taste better — and mean more — when you can trace them back to the soil.
        </p>
    </div>
</section>

<section class="py-16 px-6 lg:px-12 bg-farm-50 text-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-farm-300 mx-auto mb-4" viewBox="0 0 24 24" fill="currentColor">
        <path d="M7 7c-2.2 0-4 1.8-4 4v6h6v-6H6c0-1.1.9-2 2-2V7Zm11 0c-2.2 0-4 1.8-4 4v6h6v-6h-3c0-1.1.9-2 2-2V7Z"/>
    </svg>
    <p class="font-display italic text-2xl text-farm-700 max-w-2xl mx-auto">
        "We did not plan to become a restaurant. The cows planned it for us."
    </p>
</section>

<section class="py-12 px-6 lg:px-12 text-center">
    <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="text-farm-600 font-display text-xl hover:text-farm-500 cursor-pointer">
        Come visit the farm →
    </a>
</section>

@endsection
