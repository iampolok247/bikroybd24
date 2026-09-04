<nav class="hidden lg:block bg-white border-b border-slate-200 text-slate-700 text-sm font-semibold">
    <div class="max-w-[1400px] mx-auto px-4 flex items-center justify-between h-12">
        
        <!-- Left Categories Dropdown & Core Links -->
        <div class="flex items-center gap-6">
            
            <!-- All Categories Dropdown Button -->
            <a href="{{ route('categories') }}" class="flex items-center gap-2.5 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm">
                <i class="fa-solid fa-grid-2 text-sm"></i>
                <span>All Categories</span>
                <i class="fa-solid fa-chevron-down text-[10px] ml-1 opacity-80"></i>
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center gap-6 text-xs uppercase tracking-wider font-bold">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('home') ? 'text-emerald-600 font-extrabold' : 'text-slate-700' }}">
                    Home
                </a>
                <a href="{{ route('catalog') }}" class="hover:text-emerald-600 transition {{ request()->routeIs('catalog') ? 'text-emerald-600 font-extrabold' : 'text-slate-700' }}">
                    All Products
                </a>
                <a href="{{ route('catalog', ['section' => 'flash_sale']) }}" class="hover:text-amber-600 text-rose-600 transition flex items-center gap-1">
                    <i class="fa-solid fa-bolt animate-bounce"></i> Flash Sales
                </a>
                <a href="{{ route('page.how-to-order') }}" class="hover:text-emerald-600 transition text-slate-700">
                    How to Order
                </a>
                <a href="{{ route('page.shipping') }}" class="hover:text-emerald-600 transition text-slate-700">
                    Shipping & Delivery
                </a>
                <a href="{{ route('page.help') }}" class="hover:text-emerald-600 transition text-slate-700">
                    Customer Support
                </a>
            </div>

        </div>

        <!-- Right Promo / Hotline Highlights -->
        <div class="flex items-center gap-4 text-xs font-bold">
            <span class="bg-rose-50 text-rose-600 px-3 py-1 rounded-full border border-rose-200/60 flex items-center gap-1.5">
                <i class="fa-solid fa-tags"></i> ৳500 Coupon: <span class="text-rose-700 font-black">NEXABD500</span>
            </span>
            <a href="tel:{{ $cms['hotline'] ?? '+8801854288311' }}" class="text-slate-800 hover:text-emerald-600 transition flex items-center gap-1.5">
                <i class="fa-solid fa-headset text-emerald-600 text-sm"></i>
                <span>{{ $cms['hotline'] ?? '+8801854288311' }}</span>
            </a>
        </div>

    </div>
</nav>
