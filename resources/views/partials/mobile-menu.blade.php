<!-- Mobile Menu Drawer Backdrop & Panel -->
<div id="mobile-menu-container" class="fixed inset-0 z-50 overflow-hidden hidden transition-opacity duration-300" role="dialog" aria-modal="true">
    <div id="mobile-menu-backdrop" onclick="window.App.closeMobileMenu()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 cursor-pointer"></div>

    <div class="fixed inset-y-0 left-0 max-w-full flex pr-10">
        <div id="mobile-menu-panel" class="w-screen max-w-xs sm:max-w-sm bg-white shadow-2xl flex flex-col transform -translate-x-full transition duration-300 ease-in-out">
            
            <!-- Mobile Menu Header -->
            <div class="p-4 bg-slate-900 text-white flex items-center justify-between">
                <a href="{{ route('home') }}" onclick="window.App.closeMobileMenu()" class="flex items-center gap-2">
                    <img src="{{ asset($cms['logoUrl'] ?? 'logo.png') }}" alt="BikroyBD24" class="h-8 w-auto brightness-0 invert" onerror="this.src='/logo.png'">
                </a>
                <button onclick="window.App.closeMobileMenu()" class="text-slate-400 hover:text-white p-2 rounded-xl">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar">
                
                <!-- Quick User Profile Card -->
                <div class="bg-emerald-50 rounded-2xl p-4 flex items-center gap-3 border border-emerald-100">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Welcome to BikroyBD24</h4>
                        <button onclick="window.App.closeMobileMenu(); window.App.openLoginModal();" class="text-[11px] text-emerald-700 font-bold hover:underline">
                            Login / Register
                        </button>
                    </div>
                </div>

                <!-- Primary Nav Links -->
                <div class="space-y-1 text-sm font-semibold text-slate-700">
                    <a href="{{ route('home') }}" onclick="window.App.closeMobileMenu()" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 hover:text-emerald-600 transition">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-house text-slate-400"></i> Home</span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </a>
                    <a href="{{ route('catalog') }}" onclick="window.App.closeMobileMenu()" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 hover:text-emerald-600 transition">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-bag-shopping text-slate-400"></i> All Products</span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </a>
                    <a href="{{ route('categories') }}" onclick="window.App.closeMobileMenu()" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 hover:text-emerald-600 transition">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-grid-2 text-slate-400"></i> All Categories</span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </a>
                    <a href="{{ route('catalog', ['section' => 'flash_sale']) }}" onclick="window.App.closeMobileMenu()" class="flex items-center justify-between p-3 rounded-xl hover:bg-rose-50 text-rose-600 transition">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-bolt text-rose-500"></i> Flash Deals</span>
                        <span class="bg-rose-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">HOT</span>
                    </a>
                    <a href="{{ route('wishlist') }}" onclick="window.App.closeMobileMenu()" class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 hover:text-emerald-600 transition">
                        <span class="flex items-center gap-3"><i class="fa-regular fa-heart text-slate-400"></i> Wishlist</span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </a>
                    <button onclick="window.App.closeMobileMenu(); window.App.openTrackingModal();" class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-slate-100 hover:text-emerald-600 transition text-left">
                        <span class="flex items-center gap-3"><i class="fa-solid fa-truck-fast text-slate-400"></i> Track Order</span>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-300"></i>
                    </button>
                </div>

                <div class="border-t border-slate-200 pt-3">
                    <h5 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Customer Care</h5>
                    <div class="space-y-1 text-xs font-semibold text-slate-600">
                        <a href="{{ route('page.how-to-order') }}" onclick="window.App.closeMobileMenu()" class="block p-2 rounded-lg hover:bg-slate-100">How to Order</a>
                        <a href="{{ route('page.shipping') }}" onclick="window.App.closeMobileMenu()" class="block p-2 rounded-lg hover:bg-slate-100">Shipping Policy</a>
                        <a href="{{ route('page.returns') }}" onclick="window.App.closeMobileMenu()" class="block p-2 rounded-lg hover:bg-slate-100">Returns & Refunds</a>
                        <a href="{{ route('page.help') }}" onclick="window.App.closeMobileMenu()" class="block p-2 rounded-lg hover:bg-slate-100">Help & Support</a>
                        <a href="{{ route('admin.login') }}" class="block p-2 rounded-lg text-emerald-700 font-bold hover:bg-emerald-50">Admin CMS Login</a>
                    </div>
                </div>

            </div>

            <!-- Mobile Drawer Bottom Contact -->
            <div class="p-4 bg-slate-50 border-t border-slate-200 text-xs text-slate-600 space-y-1">
                <p class="font-bold text-slate-800 flex items-center gap-1.5">
                    <i class="fa-solid fa-phone text-emerald-600"></i> Hotline: {{ $cms['hotline'] ?? '+8801854288311' }}
                </p>
                <p class="text-[11px] text-slate-500">24/7 Support via WhatsApp & Gemini AI</p>
            </div>

        </div>
    </div>
</div>
