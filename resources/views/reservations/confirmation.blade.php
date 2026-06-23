@extends('layouts.app')

@section('content')

<div class="pt-32 pb-20 px-6 lg:px-12 max-w-2xl mx-auto text-center">
    <img src="/images/mascot/cow_mascot_apron.svg" alt="" class="h-28 mx-auto mb-6" loading="lazy">

    <h1 class="font-display text-3xl text-farm-900 mb-4">{{ __('reservations.confirmation_title') }}</h1>
    <p class="text-earth-700 mb-8">{{ __('reservations.confirmation_body') }}</p>

    <div class="bg-farm-50 rounded-2xl p-6 text-left mb-8 space-y-2">
        <p><span class="font-bold text-farm-900">{{ __('reservations.full_name') }}:</span> {{ $reservation->name }}</p>
        <p><span class="font-bold text-farm-900">{{ __('reservations.date') }}:</span> {{ $reservation->date->format('d M Y') }}</p>
        <p><span class="font-bold text-farm-900">{{ __('reservations.time') }}:</span> {{ $reservation->time }}</p>
        <p><span class="font-bold text-farm-900">{{ __('reservations.guests') }}:</span> {{ $reservation->guests }}</p>
    </div>

    <a
        href="https://wa.me/6281234567890?text={{ rawurlencode("Hi Gundaling Farmstead, I've just made a reservation online. Name: {$reservation->name}, Date: {$reservation->date->format('d M Y')}, Time: {$reservation->time}, Guests: {$reservation->guests}") }}"
        target="_blank" rel="noopener"
        class="inline-block bg-[#25D366] text-white font-bold px-8 py-3 rounded-full hover:opacity-90 transition-opacity duration-200 cursor-pointer"
    >
        {{ __('reservations.confirm_via_whatsapp') }}
    </a>
</div>

@endsection
