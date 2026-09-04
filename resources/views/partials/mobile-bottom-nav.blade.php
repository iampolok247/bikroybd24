<!-- Fixed Mobile Bottom Navigation Bar (App-like feel) -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 px-2 py-1.5 shadow-[0_-4px_20px_rgba(0,0,0,0.08)]">
    <div class="grid grid-cols-5 gap-1 items-center max-w-md mx-auto text-center">
        
        <!-- Home Link -->
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center py-1 text-[11px] font-bold {{ request()->routeIs('home') ? 'text-emerald-600' : 'text-slate-500 hover:text-slate-900' }}">
            <i class="fa-solid fa-house text-lg mb-0.5"></i>
            <span>Home</span>
        </a>

        <!-- Categories Link -->
        <a href="{{ route('categories') }}" class="flex flex-col items-center justify-center py-1 text-[11px] font-bold {{ request()->routeIs('categories') ? 'text-emerald-600' : 'text-slate-500 hover:text-slate-900' }}">
            <i class="fa-solid fa-grid-2 text-lg mb-0.5"></i>
            <span>Categories</span>
        </a>

        <!-- Middle Cart Floating Action Button -->
        <div class="relative flex justify-center -mt-5">
            <button 
                onclick="window.App.openCart()" 
                class="w-13 h-13 rounded-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white flex flex-col items-center justify-center shadow-lg shadow-emerald-600/30 border-4 border-white cursor-pointer"
                aria-label="Open Cart"
            >
                <i class="fa-solid fa-cart-shopping text-lg"></i>
                <span id="mobile-bottom-cart-badge" class="absolute top-0 right-0 bg-amber-400 text-slate-900 text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">0</span>
            </button>
        </div>

        <!-- Wishlist Link -->
        <a href="{{ route('wishlist') }}" class="flex flex-col items-center justify-center py-1 text-[11px] font-bold {{ request()->routeIs('wishlist') ? 'text-rose-600' : 'text-slate-500 hover:text-slate-900' }}">
            <i class="fa-regular fa-heart text-lg mb-0.5"></i>
            <span>Wishlist</span>
        </a>

        <!-- Track / Account Link -->
        <button onclick="window.App.openTrackingModal()" class="flex flex-col items-center justify-center py-1 text-[11px] font-bold text-slate-500 hover:text-slate-900 cursor-pointer">
            <i class="fa-solid fa-truck-fast text-lg mb-0.5"></i>
            <span>Track</span>
        </button>

    </div>
</div>
