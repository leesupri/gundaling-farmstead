<div
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-50"
    x-transition:enter-end="opacity-100 scale-100"
    x-cloak
    class="fixed bottom-8 right-8 z-50"
>
    <a
        href="https://wa.me/6282162599980?text={{ rawurlencode(__('common.wa_prefill_message')) }}"
        target="_blank"
        rel="noopener"
        aria-label="{{ __('common.chat_on_whatsapp') }}"
        class="flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] shadow-lg hover:scale-105 transition-transform duration-200 cursor-pointer"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 fill-white">
            <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.93.55 3.73 1.5 5.26L2 22l4.96-1.6a9.86 9.86 0 0 0 5.08 1.39c5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2Zm0 18.07c-1.6 0-3.1-.43-4.4-1.2l-.31-.18-3.2 1.03 1.05-3.12-.2-.32a8.07 8.07 0 0 1-1.27-4.37c0-4.48 3.65-8.13 8.13-8.13 4.48 0 8.13 3.65 8.13 8.13 0 4.48-3.65 8.16-8.13 8.16Zm4.47-6.1c-.24-.12-1.43-.71-1.65-.79-.22-.08-.38-.12-.55.12-.16.24-.62.79-.76.95-.14.16-.28.18-.52.06-1.41-.7-2.33-1.25-3.26-2.83-.25-.42.25-.39.71-1.3.08-.16.04-.3-.03-.42-.08-.12-.6-1.45-.82-1.93-.22-.48-.45-.41-.62-.42-.16-.01-.35-.01-.54-.01-.18 0-.48.07-.74.34-.25.27-.97.95-.97 2.3 0 1.36.99 2.67 1.13 2.86.14.18 1.92 2.93 4.65 4 2.74 1.07 2.74.71 3.23.66.49-.04 1.43-.58 1.63-1.15.2-.56.2-1.04.14-1.15-.06-.1-.24-.16-.49-.28Z"/>
        </svg>
    </a>
</div>
