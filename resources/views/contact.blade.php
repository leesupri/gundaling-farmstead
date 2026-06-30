@extends('layouts.app')

@section('content')

@php
    $prefix = app()->getLocale() === 'id' ? 'id.' : '';
    $isId = app()->getLocale() === 'id';
@endphp

<section class="relative h-[40vh] overflow-hidden">
    <img src="/images/hero/Resto.jpg" alt="Stone entrance path leading to Gundaling Farmstead" class="hero-bg absolute inset-0 w-full h-full object-cover" style="object-position: center 70%" loading="eager">
    <div class="absolute inset-0 bg-linear-to-b from-black/40 to-black/70"></div>
    <div class="relative h-full flex items-center justify-center text-center px-6">
        <div class="hero-content-fade">
            <h1 class="font-display text-white text-3xl lg:text-5xl mb-2">{{ $isId ? 'Kunjungi Kami' : 'Visit Us' }}</h1>
            <p class="text-farm-100">{{ $isId ? 'Kami senang menyambut Anda' : "We'd love to welcome you" }}</p>
        </div>
    </div>
</section>

<div class="pt-16 pb-20 px-6 lg:px-12 max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-12">
        {{-- LEFT --}}
        <div class="space-y-6">
            <div>
                <h3 class="font-display text-lg text-farm-900 mb-2">{{ $isId ? 'Alamat' : 'Address' }}</h3>
                <p class="text-earth-700">Jl. Jamin Ginting, Desa Jaranguda, Simpang Pelawi, Kabupaten Karo, Berastagi 22158, North Sumatra, Indonesia</p>
            </div>

            <div>
                <h3 class="font-display text-lg text-farm-900 mb-2">{{ __('reservations.hours_title') }}</h3>
                <p class="text-earth-700">{{ __('reservations.hours_value') }}</p>
            </div>

            <div>
                <h3 class="font-display text-lg text-farm-900 mb-2">{{ $isId ? 'Telepon' : 'Phone' }}</h3>
                <a href="https://wa.me/6282162599980" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-[#25D366] text-white font-bold px-5 py-2.5 rounded-full hover:opacity-90 transition-opacity duration-200 cursor-pointer">
                    {{ __('common.chat_on_whatsapp') }}
                </a>
            </div>

            <div>
                <h3 class="font-display text-lg text-farm-900 mb-2">Email</h3>
                <a href="mailto:info@gundalingfarmstead.com" class="text-farm-600 hover:text-farm-500 cursor-pointer">info@pimsgundaling.com</a>
            </div>

            <div>
                <h3 class="font-display text-lg text-farm-900 mb-2">Instagram</h3>
                <a href="https://instagram.com/gundaling_farmstead" target="_blank" rel="noopener" class="text-farm-600 hover:text-farm-500 cursor-pointer">@gundaling_farmstead</a>
            </div>

            <iframe
                src="https://www.openstreetmap.org/export/embed.html?bbox=98.503194,3.206194,98.513194,3.216194&layer=mapnik&marker=3.211194,98.508194"
                width="100%" height="280" class="rounded-xl border-0"
                loading="lazy"
                title="Gundaling Farmstead location"
            ></iframe>
        </div>

        {{-- RIGHT: Alpine.js contact form --}}
        <div
            x-data="{
                form: { name: '', email: '', subject: '', message: '' },
                sending: false,
                sent: false,
                async submit() {
                    this.sending = true;
                    const res = await fetch('{{ route($prefix . 'contact.store') }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify(this.form),
                    });
                    this.sending = false;
                    this.sent = res.ok;
                }
            }"
            class="bg-white rounded-2xl p-8 shadow-sm"
        >
            <template x-if="sent">
                <p class="text-farm-600 font-bold flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $isId ? 'Pesan terkirim! Kami akan membalas dalam 24 jam.' : "Message sent! We'll reply within 24 hours." }}
                </p>
            </template>

            <form x-show="!sent" @submit.prevent="submit" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">{{ $isId ? 'Nama' : 'Name' }}</label>
                    <input type="text" x-model="form.name" required class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">Email</label>
                    <input type="email" x-model="form.email" required class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">{{ $isId ? 'Subjek' : 'Subject' }}</label>
                    <input type="text" x-model="form.subject" required class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-farm-900 mb-1">{{ $isId ? 'Pesan' : 'Message' }}</label>
                    <textarea x-model="form.message" required rows="5" class="w-full border border-earth-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-farm-500"></textarea>
                </div>
                <button
                    type="submit"
                    :disabled="sending"
                    class="w-full bg-farm-600 text-white font-bold py-3 rounded-full hover:bg-farm-500 transition-colors duration-200 disabled:opacity-60 cursor-pointer"
                >
                    <span x-show="!sending">{{ $isId ? 'Kirim Pesan' : 'Send Message' }}</span>
                    <span x-show="sending">{{ $isId ? 'Mengirim...' : 'Sending...' }}</span>
                </button>
            </form>
        </div>
    </div>

    <div class="mt-16 text-center">
        <p class="text-earth-700 mb-3">{{ $isId ? 'Mencari produk farm atau wisata edukasi?' : 'Looking for farm products or field trips?' }}</p>
        <a href="https://gundalingfarm.com" target="_blank" rel="noopener" class="text-farm-600 font-display text-lg hover:text-farm-500 cursor-pointer">
            {{ $isId ? 'Kunjungi Gundaling Farm' : 'Visit Gundaling Farm' }} →
        </a>
    </div>
</div>

@endsection
