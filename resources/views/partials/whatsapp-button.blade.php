<!-- WhatsApp Direct Hotline Floating Action Button -->
<div class="fixed bottom-20 lg:bottom-6 left-4 sm:left-6 z-40">
    <a 
        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cms['hotline'] ?? '8801854288311') }}?text={{ urlencode('Hello BikroyBD24, I have an inquiry about shopping on your website.') }}" 
        target="_blank" 
        rel="noopener noreferrer"
        class="bg-[#25D366] hover:bg-[#20bd5a] hover:scale-105 active:scale-95 text-white p-3.5 sm:p-4 rounded-full shadow-2xl shadow-emerald-900/30 flex items-center justify-center relative transition-all duration-300 border-2 border-white group"
        title="Chat on WhatsApp"
        aria-label="Chat on WhatsApp"
    >
        <i class="fa-brands fa-whatsapp text-2xl group-hover:scale-110 transition-transform"></i>
        <span class="hidden sm:inline-block ml-2 text-xs font-black tracking-wide pr-1">WhatsApp</span>
    </a>
</div>
