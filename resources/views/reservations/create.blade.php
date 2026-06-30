@extends('layouts.app')

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
@endphp

<section class="relative h-[40vh] overflow-hidden">
    <img src="/images/hero/Supriadi-golden-hour-17-07-22-5.jpg" alt="Gundaling Farmstead restaurant exterior at golden hour" class="hero-bg absolute inset-0 w-full h-full object-cover" style="object-position: center 35%" loading="eager">
    <div class="absolute inset-0 bg-linear-to-b from-black/40 to-black/70"></div>
    <div class="relative h-full flex items-center justify-center">
        <h1 class="hero-content-fade font-display text-white text-3xl lg:text-5xl">{{ __('reservations.title') }}</h1>
    </div>
</section>

<div class="pt-16 pb-20 px-6 lg:px-12 max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-12">
        {{-- LEFT: form --}}
        <form
            method="POST"
            action="{{ route($prefix . 'reservations.store') }}"
            x-data="{ isGroupEvent: false }"
            class="bg-white rounded-2xl p-8 shadow-sm space-y-5"
        >
            @csrf

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.full_name') }}</label>
                <input type="text" name="name" required value="{{ old('name') }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.email') }}</label>
                <input type="email" name="email" required value="{{ old('email') }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.whatsapp_number') }}</label>
                <input type="tel" name="phone" required placeholder="08xx / +62xx" value="{{ old('phone') }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                @error('phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.date') }}</label>
                    <input type="date" name="date" required min="{{ now()->format('Y-m-d') }}" value="{{ old('date') }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                    @error('date') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.time') }}</label>
                    <select name="time" required class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                        @foreach (['10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00'] as $t)
                            <option value="{{ $t }}" @selected(old('time') === $t)>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('time') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.guests') }}</label>
                <input type="number" name="guests" min="1" max="500" required value="{{ old('guests', 2) }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                @error('guests') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.occasion') }}</label>
                <select name="occasion" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                    <option value="">—</option>
                    <option value="Birthday">{{ __('reservations.occasion_birthday') }}</option>
                    <option value="Anniversary">{{ __('reservations.occasion_anniversary') }}</option>
                    <option value="Business Dinner">{{ __('reservations.occasion_business') }}</option>
                    <option value="Wedding">{{ __('reservations.occasion_wedding') }}</option>
                    <option value="Large Group">{{ __('reservations.occasion_large_group') }}</option>
                    <option value="Other">{{ __('reservations.occasion_other') }}</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.notes') }}</label>
                <textarea name="notes" rows="3" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">{{ old('notes') }}</textarea>
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" x-model="isGroupEvent" class="w-4 h-4 accent-farm-600">
                <span class="text-sm text-earth-700">{{ __('reservations.is_group_event') }}</span>
            </label>

            <div x-show="isGroupEvent" x-cloak>
                <label class="block text-sm font-bold text-farm-900 mb-1">{{ __('reservations.group_name') }}</label>
                <input type="text" name="group_name" value="{{ old('group_name') }}" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
            </div>

            <button type="submit" class="w-full bg-farm-600 text-white font-bold py-3 rounded-full hover:bg-farm-500 transition-colors duration-200 cursor-pointer">
                {{ __('reservations.submit') }}
            </button>
        </form>

        {{-- RIGHT: info panel --}}
        <div class="space-y-6">
            <div class="bg-farm-50 rounded-2xl p-6">
                <h3 class="font-display text-lg text-farm-900 mb-2">{{ __('reservations.hours_title') }}</h3>
                <p class="text-earth-700">{{ __('reservations.hours_value') }}</p>
            </div>

            <iframe
                src="https://www.openstreetmap.org/export/embed.html?bbox=98.503194,3.206194,98.513194,3.216194&layer=mapnik&marker=3.211194,98.508194"
                width="100%" height="280" class="rounded-xl border-0"
                loading="lazy"
                title="Gundaling Farmstead location"
            ></iframe>

            <div class="flex justify-center">
                <img src="/images/mascot/cow_mascot_apron.svg" alt="" class="mascot-idle h-32" loading="lazy">
            </div>
        </div>
    </div>
</div>

@endsection
