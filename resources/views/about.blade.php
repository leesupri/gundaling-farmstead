@extends('layouts.app')

@section('content')

<section class="relative h-[60vh] overflow-hidden">
    <img src="/images/hero/DJI_0016-1.jpg" alt="Aerial view of Gundaling Farmstead, garden and mountains beyond" class="hero-bg absolute inset-0 w-full h-full object-cover" style="object-position: center 60%" loading="eager" fetchpriority="high">
    <div class="absolute inset-0 bg-linear-to-b from-black/40 to-black/70"></div>
    <div class="relative h-full flex items-center justify-center">
        <h1 class="hero-content-fade font-display text-white text-4xl lg:text-6xl">{{ __('about.hero_title') }}</h1>
    </div>
</section>

<section class="timeline relative py-20 px-6 lg:px-12 max-w-4xl mx-auto overflow-hidden">
    <img src="/images/hero/resto-farm.png" alt="" class="absolute inset-0 w-full h-full object-cover opacity-15" loading="lazy">
    <div class="relative">
        <div class="timeline-connector absolute left-0 right-0 top-4 h-0.5 bg-farm-300 hidden lg:block"></div>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            @foreach ([
                ['year' => '2005', 'text' => __('about.timeline_2005')],
                ['year' => '2018', 'text' => __('about.timeline_2018')],
                ['year' => '2019', 'text' => __('about.timeline_2019')],
                ['year' => __('about.timeline_now_label'), 'text' => __('about.timeline_now')],
            ] as $stop)
                <div class="relative pl-6 lg:pl-0 lg:text-center">
                    <span class="timeline-dot absolute lg:relative lg:block left-0 lg:mx-auto w-3 h-3 rounded-full bg-farm-600 top-2 lg:top-0 lg:mb-4"></span>
                    <h3 class="font-display text-xl text-farm-600">{{ $stop['year'] }}</h3>
                    <p class="text-earth-700 text-sm mt-1">{{ $stop['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 px-6 lg:px-12 max-w-3xl mx-auto space-y-12">
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">{{ __('about.story1_title') }}</h2>
        <p class="text-earth-700 leading-relaxed">
            {{ __('about.story1_body') }}
        </p>
    </div>
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">{{ __('about.story2_title') }}</h2>
        <p class="text-earth-700 leading-relaxed">
            {{ __('about.story2_body') }}
        </p>
    </div>
    <div>
        <h2 class="font-display text-2xl text-farm-900 mb-3">{{ __('about.story3_title') }}</h2>
        <p class="text-earth-700 leading-relaxed">
            {{ __('about.story3_body') }}
        </p>
    </div>
</section>

<section class="py-16 px-6 lg:px-12 bg-farm-50 text-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-farm-300 mx-auto mb-4" viewBox="0 0 24 24" fill="currentColor">
        <path d="M7 7c-2.2 0-4 1.8-4 4v6h6v-6H6c0-1.1.9-2 2-2V7Zm11 0c-2.2 0-4 1.8-4 4v6h6v-6h-3c0-1.1.9-2 2-2V7Z"/>
    </svg>
    <p class="font-display italic text-2xl text-farm-700 max-w-2xl mx-auto">
        "{{ __('about.quote') }}"
    </p>
</section>

<section class="scene relative py-32 px-6 lg:px-12 overflow-hidden">
    <img src="/images/hero/supriadi-lee-pims-9_orig.jpg" alt="Gundaling Farm fields with Mt. Sinabung" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
    <div class="absolute inset-0 bg-linear-to-t from-farm-950/90 via-farm-950/40 to-transparent"></div>
    <div class="scene-text relative max-w-2xl mx-auto text-center">
        <h2 class="font-display text-3xl lg:text-4xl text-white mb-6">{{ __('about.bridge_title') }}</h2>
        <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="inline-block bg-gold text-farm-950 px-8 py-3 rounded-full font-bold hover:bg-amber transition-colors duration-200 cursor-pointer">
            {{ __('about.bridge_cta') }} →
        </a>
    </div>
</section>

@endsection
