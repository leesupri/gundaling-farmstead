@php
    $locale = app()->getLocale();
    $prefix = $locale === 'id' ? 'id.' : '';
@endphp

<footer class="bg-farm-950 text-farm-100 font-sans">
    <div class="relative h-20 overflow-hidden">
        <img src="/images/mascot/cow_mascot_apron.svg" alt="" class="walk-mascot absolute bottom-1.5 h-16" loading="lazy">
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-farm-600"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12 grid grid-cols-1 lg:grid-cols-4 gap-10">
        <div>
            <img src="/images/logos/Logo_GUNDALING_2-color_tall_on-white.png" alt="Gundaling Farmstead" class="h-12 mb-4">
            <p class="text-farm-300 mb-4">{{ __('common.footer_brand_tagline') }}</p>
            <div class="flex gap-2 flex-wrap text-xs">
                <span class="bg-farm-800 text-farm-200 px-3 py-1 rounded-full">{{ __('common.footer_organic') }}</span>
                <span class="bg-farm-800 text-farm-200 px-3 py-1 rounded-full">{{ __('common.footer_est') }}</span>
                <span class="bg-farm-800 text-farm-200 px-3 py-1 rounded-full">{{ __('common.footer_open_kitchen') }}</span>
            </div>
        </div>

        <div>
            <h3 class="font-display text-lg text-white mb-4">{{ __('common.footer_restaurant') }}</h3>
            <ul class="space-y-2 text-farm-300">
                <li><a href="{{ route($prefix . 'menu') }}" class="hover:text-gold cursor-pointer">{{ __('nav.menu') }}</a></li>
                <li><a href="{{ route($prefix . 'reservations') }}" class="hover:text-gold cursor-pointer">{{ __('nav.reserve') }}</a></li>
                <li><a href="{{ route($prefix . 'promo') }}" class="hover:text-gold cursor-pointer">{{ __('nav.promo') }}</a></li>
                <li><a href="{{ route($prefix . 'about') }}" class="hover:text-gold cursor-pointer">{{ __('nav.about') }}</a></li>
                <li><a href="{{ route($prefix . 'contact') }}" class="hover:text-gold cursor-pointer">{{ __('nav.contact') }}</a></li>
            </ul>
        </div>

        <div>
            <h3 class="font-display text-lg text-white mb-4">{{ __('common.footer_the_farm') }}</h3>
            <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="text-farm-300 hover:text-gold cursor-pointer">
                {{ __('common.footer_visit_farm') }} ↗
            </a>
        </div>

        <div>
            <h3 class="font-display text-lg text-white mb-4">{{ __('common.footer_find_us') }}</h3>
            <address class="text-farm-300 not-italic space-y-1">
                <p>Jl. Jamin Ginting, Desa Jaranguda, Simpang Pelawi, Kabupaten Karo, Berastagi 22158, North Sumatra</p>
                <p>{{ __('reservations.hours_value') }}</p>
                <p><a href="https://wa.me/6281234567890" target="_blank" rel="noopener" class="hover:text-gold cursor-pointer">+62 812-3456-7890</a></p>
                <p><a href="mailto:info@gundalingfarmstead.com" class="hover:text-gold cursor-pointer">info@gundalingfarmstead.com</a></p>
            </address>
        </div>
    </div>

    <div class="border-t border-farm-800 py-6 px-6 lg:px-12 text-center text-farm-400 text-sm">
        © {{ date('Y') }} Gundaling Farmstead · PT. Anugerah Alam Berastagi
        <span class="mx-2">|</span>
        <a href="https://pimsgundaling.com" target="_blank" rel="noopener" class="hover:text-gold cursor-pointer">pimsgundaling.com</a>
        <span class="mx-1">|</span>
        <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="hover:text-gold cursor-pointer">gundalingfarm.com</a>
    </div>
</footer>
