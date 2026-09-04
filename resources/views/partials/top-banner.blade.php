<div class="bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-800 text-white text-xs py-2 px-4 shadow-sm border-b border-emerald-600/30">
    <div class="max-w-[1400px] mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2 overflow-hidden whitespace-nowrap">
            <span class="bg-amber-400 text-slate-900 font-extrabold text-[10px] px-2 py-0.5 rounded-full uppercase tracking-wider animate-pulse flex items-center gap-1">
                <i class="fa-solid fa-bolt"></i> HOT DEAL
            </span>
            <p class="font-medium text-emerald-50 text-[11px] sm:text-xs truncate">
                {{ $cms['topBannerText'] ?? '⚡ FLASH SALE ACTIVE: UP TO 70% OFF ON ELECTRONICS & GADGETS! FREE DELIVERY OVER ৳3,000!' }}
            </p>
        </div>
        <div class="hidden md:flex items-center gap-4 text-[11px] text-emerald-100 shrink-0 font-medium">
            <a href="tel:{{ $cms['hotline'] ?? '+8801854288311' }}" class="hover:text-white transition flex items-center gap-1.5">
                <i class="fa-solid fa-phone"></i> Hotline: {{ $cms['hotline'] ?? '+8801854288311' }}
            </a>
            <span class="text-emerald-500">|</span>
            <button onclick="window.App.openTrackingModal()" class="hover:text-white transition flex items-center gap-1.5 cursor-pointer">
                <i class="fa-solid fa-truck-fast"></i> Track Order
            </button>
            <span class="text-emerald-500">|</span>
            <a href="{{ route('admin.login') }}" class="hover:text-amber-300 transition flex items-center gap-1">
                <i class="fa-solid fa-lock"></i> Admin CMS
            </a>
        </div>
    </div>
</div>
