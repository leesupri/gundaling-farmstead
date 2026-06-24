<div
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => {
        show = (window.scrollY + window.innerHeight) >= (document.documentElement.scrollHeight - 400);
    })"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-50"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-50"
    x-cloak
    class="fixed bottom-8 left-8 z-50"
>
    <button
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        aria-label="Back to top"
        class="flex items-center justify-center w-14 h-14 rounded-full bg-farm-600 text-white shadow-lg hover:bg-farm-500 hover:scale-105 transition-all duration-200 cursor-pointer"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>
</div>
