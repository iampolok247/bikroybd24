<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200">
    <div class="max-w-[1400px] mx-auto px-3 sm:px-4 py-2 sm:py-3">
        <div class="flex items-center justify-between gap-2 sm:gap-4 h-[56px] sm:h-[64px]">
            
            <!-- Mobile Hamburger & Brand Logo -->
            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                <button 
                    onclick="window.App.openMobileMenu()"
                    class="lg:hidden text-slate-700 hover:text-emerald-700 p-2 rounded-xl hover:bg-slate-100 transition cursor-pointer"
                    aria-label="Open Mobile Menu"
                >
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

                <a href="{{ route('home') }}" class="flex items-center gap-2 group shrink-0">
                    <img 
                        src="{{ asset($cms['logoUrl'] ?? 'logo.png') }}" 
                        alt="BikroyBD24" 
                        class="h-9 sm:h-12 w-auto object-contain transition-transform group-hover:scale-105"
                        onerror="this.src='/logo.png'"
                    >
                </a>
            </div>

            <!-- Instant Live Search Bar (Desktop & Tablet) -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-4 relative">
                <form action="{{ route('catalog') }}" method="GET" class="w-full relative">
                    <div class="relative flex items-center w-full bg-slate-100/90 hover:bg-slate-100 rounded-full border border-slate-200 focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/20 transition-all overflow-hidden h-11 px-4">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm mr-3"></i>
                        <input 
                            type="text" 
                            name="search"
                            id="header-search-input"
                            value="{{ request('search') }}"
                            placeholder="{{ $cms['searchPlaceholder'] ?? 'Search 10,000+ products, brands and gadgets...' }}"
                            autocomplete="off"
                            class="w-full bg-transparent text-sm text-slate-900 font-medium placeholder-slate-400 focus:outline-none"
                            oninput="window.App.handleLiveSearch(this.value)"
                        >
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2 rounded-full transition ml-2 shadow-sm cursor-pointer">
                            Search
                        </button>
                    </div>

                    <!-- Live Autocomplete Dropdown -->
                    <div id="live-search-dropdown" class="hidden absolute left-0 right-0 top-full mt-2 bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-50 max-h-96 overflow-y-auto">
                        <!-- Injected via app.js -->
                    </div>
                </form>
            </div>

            <!-- Right Action Icons: Track, Wishlist, Cart, Account -->
            <div class="flex items-center gap-1 sm:gap-2 shrink-0">
                
                <!-- Track Order Button (Desktop) -->
                <button 
                    onclick="window.App.openTrackingModal()"
                    class="hidden xl:flex items-center gap-2 text-slate-700 hover:text-emerald-700 font-semibold text-xs px-3 py-2 rounded-xl hover:bg-slate-100 transition cursor-pointer"
                >
                    <i class="fa-solid fa-truck-fast text-base text-emerald-600"></i>
                    <span>Track Order</span>
                </button>

                <!-- Wishlist Button -->
                <a 
                    href="{{ route('wishlist') }}"
                    class="relative flex items-center justify-center p-2.5 rounded-xl text-slate-700 hover:text-rose-600 hover:bg-rose-50 transition cursor-pointer"
                    title="My Wishlist"
                >
                    <i class="fa-regular fa-heart text-xl"></i>
                    <span id="wishlist-badge" class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-extrabold w-5 h-5 rounded-full flex items-center justify-center shadow-sm">0</span>
                </a>

                <!-- Cart Button with Slide Drawer Trigger -->
                <button 
                    onclick="window.App.openCart()"
                    class="relative flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold text-xs sm:text-sm px-3.5 py-2.5 rounded-xl transition shadow-md shadow-emerald-600/20 cursor-pointer"
                >
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-cart-shopping text-base"></i>
                        <span id="cart-badge-count" class="absolute -top-2 -right-3 bg-amber-400 text-slate-900 text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">0</span>
                    </div>
                    <span class="hidden sm:inline-block ml-1 font-extrabold" id="cart-badge-total">৳0</span>
                </button>

                <!-- User Account / Login Button -->
                <button 
                    onclick="window.App.openLoginModal()"
                    class="flex items-center gap-2 text-slate-700 hover:text-emerald-700 p-2.5 rounded-xl hover:bg-slate-100 transition cursor-pointer"
                    title="Account Login"
                >
                    <i class="fa-regular fa-user text-xl"></i>
                </button>

            </div>

        </div>

        <!-- Mobile Search Bar Form -->
        <div class="md:hidden mt-2 relative">
            <form action="{{ route('catalog') }}" method="GET" class="w-full">
                <div class="flex items-center w-full bg-slate-100 rounded-full border border-slate-200 px-3.5 h-10">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs mr-2"></i>
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        class="w-full bg-transparent text-xs text-slate-900 font-medium placeholder-slate-400 focus:outline-none"
                    >
                </div>
            </form>
        </div>

    </div>
</header>
