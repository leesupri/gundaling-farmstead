@php
    $locale = app()->getLocale();
    $prefix = $locale === 'id' ? 'id.' : '';
    $bare = fn (string $name) => str_replace('id.', '', $name);

    $currentRoute = \Illuminate\Support\Facades\Route::current();
    $currentParams = $currentRoute?->parameters() ?? [];

    $resolveLocaleUrl = function (string $targetRouteName) use ($currentParams, $prefix, $bare) {
        try {
            return route($targetRouteName, $currentParams);
        } catch (\Illuminate\Routing\Exceptions\UrlGenerationException) {
            return route($targetRouteName === $bare($targetRouteName) ? 'home' : 'id.home');
        }
    };

    $enUrl = $currentRoute ? $resolveLocaleUrl($bare($currentRoute->getName())) : route('home');
    $idUrl = $currentRoute ? $resolveLocaleUrl('id.' . $bare($currentRoute->getName())) : route('id.home');
@endphp

<nav
    x-data="{ scrolled: false, open: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60)"
    :class="scrolled ? 'bg-farm-900/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
    class="fixed top-0 w-full z-50 transition-all duration-300 py-4 px-6 lg:px-12"
>
    <div class="flex items-center justify-between max-w-7xl mx-auto">
        <a href="{{ route($prefix . 'home') }}" class="shrink-0">
            <img src="/images/logos/Logo_GUNDALING_2-color_tall_on-white.png" alt="Gundaling Farmstead" class="h-12 brightness-0 invert">
        </a>

        <div class="hidden lg:flex items-center gap-8 font-sans text-white">
            <a href="{{ route($prefix . 'home') }}" class="hover:text-gold transition-colors duration-200 cursor-pointer">{{ __('nav.home') }}</a>
            <a href="{{ route($prefix . 'menu') }}" class="hover:text-gold transition-colors duration-200 cursor-pointer">{{ __('nav.menu') }}</a>
            <a href="{{ route($prefix . 'promo') }}" class="hover:text-gold transition-colors duration-200 cursor-pointer">{{ __('nav.promo') }}</a>
            <a href="{{ route($prefix . 'about') }}" class="hover:text-gold transition-colors duration-200 cursor-pointer">{{ __('nav.about') }}</a>
            <a href="{{ route($prefix . 'contact') }}" class="hover:text-gold transition-colors duration-200 cursor-pointer">{{ __('nav.contact') }}</a>

            <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="flex items-center gap-1 text-farm-200 hover:text-gold transition-colors duration-200 cursor-pointer">
                {{ __('nav.visit_farm') }} ↗
            </a>

            <div class="flex items-center gap-2 text-sm">
                <a href="{{ $enUrl }}" class="cursor-pointer {{ $locale === 'en' ? 'text-gold font-bold' : 'text-white' }}">EN</a>
                <span class="text-white/40">|</span>
                <a href="{{ $idUrl }}" class="cursor-pointer {{ $locale === 'id' ? 'text-gold font-bold' : 'text-white' }}">ID</a>
            </div>

            <a href="{{ route($prefix . 'reservations') }}" class="bg-gold text-farm-950 font-bold px-5 py-2 rounded-full hover:bg-amber transition-colors duration-200 cursor-pointer">
                {{ __('nav.reserve') }}
            </a>
        </div>

        <button @click="open = !open" class="lg:hidden text-white cursor-pointer" aria-label="{{ __('nav.toggle_menu') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition x-cloak class="lg:hidden mt-4 bg-farm-900/95 backdrop-blur-md rounded-2xl p-6 flex flex-col gap-4 font-sans text-white">
        <a href="{{ route($prefix . 'home') }}" class="cursor-pointer">{{ __('nav.home') }}</a>
        <a href="{{ route($prefix . 'menu') }}" class="cursor-pointer">{{ __('nav.menu') }}</a>
        <a href="{{ route($prefix . 'promo') }}" class="cursor-pointer">{{ __('nav.promo') }}</a>
        <a href="{{ route($prefix . 'about') }}" class="cursor-pointer">{{ __('nav.about') }}</a>
        <a href="{{ route($prefix . 'contact') }}" class="cursor-pointer">{{ __('nav.contact') }}</a>
        <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="cursor-pointer">{{ __('nav.visit_farm') }} ↗</a>
        <a href="{{ route($prefix . 'reservations') }}" class="bg-gold text-farm-950 font-bold px-5 py-2 rounded-full text-center cursor-pointer">
            {{ __('nav.reserve') }}
        </a>
    </div>
</nav>
