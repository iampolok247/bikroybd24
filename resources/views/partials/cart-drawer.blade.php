<!-- Cart Drawer Backdrop & Modal Container -->
<div id="cart-drawer-container" class="fixed inset-0 z-50 overflow-hidden hidden transition-opacity duration-300" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    
    <!-- Backdrop overlay -->
    <div id="cart-backdrop" onclick="window.App.closeCart()" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0 cursor-pointer"></div>

    <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
        <!-- Sliding panel -->
        <div id="cart-panel" class="w-screen max-w-md bg-white shadow-2xl flex flex-col transform translate-x-full transition duration-300 ease-in-out">
            
            <!-- Drawer Header -->
            <div class="px-5 py-4 bg-slate-900 text-white flex items-center justify-between shadow-md">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                        <i class="fa-solid fa-bag-shopping text-base"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-extrabold tracking-tight">Shopping Cart</h2>
                        <p class="text-xs text-slate-400"><span id="cart-drawer-count">0</span> items selected</p>
                    </div>
                </div>
                <button onclick="window.App.closeCart()" class="text-slate-400 hover:text-white p-2 rounded-xl hover:bg-slate-800 transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Free Delivery Progress Bar -->
            <div class="bg-emerald-50 p-3 border-b border-emerald-100">
                <div class="flex items-center justify-between text-xs font-bold text-emerald-800 mb-1.5">
                    <span id="delivery-progress-text">Add ৳3,000 for FREE Shipping!</span>
                    <i class="fa-solid fa-truck-fast text-emerald-600"></i>
                </div>
                <div class="w-full bg-emerald-200/60 rounded-full h-2 overflow-hidden">
                    <div id="delivery-progress-bar" class="bg-emerald-600 h-2 rounded-full transition-all duration-500" style="width: 0%"></div>
                </div>
            </div>

            <!-- Cart Items List (Scrollable Area) -->
            <div id="cart-items-wrapper" class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar">
                <!-- Injected dynamically via JS -->
            </div>

            <!-- Empty Cart State (Hidden when items present) -->
            <div id="cart-empty-state" class="hidden flex-1 flex flex-col items-center justify-center p-6 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center text-slate-300 text-3xl mb-4">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800 mb-1">Your cart is empty</h3>
                <p class="text-xs text-slate-500 mb-5">Explore our latest deals and add products to your cart.</p>
                <a href="{{ route('catalog') }}" onclick="window.App.closeCart()" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition shadow-md">
                    Start Shopping
                </a>
            </div>

            <!-- Cart Summary & Checkout Footer -->
            <div id="cart-footer-summary" class="border-t border-slate-200 bg-slate-50 p-4 space-y-3">
                
                <!-- Coupon Code Box -->
                <div class="flex items-center gap-2">
                    <input 
                        type="text" 
                        id="cart-coupon-input" 
                        placeholder="Enter promo code (e.g. NEXABD500)" 
                        class="flex-1 bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs uppercase font-bold focus:outline-none focus:border-emerald-600"
                    >
                    <button 
                        type="button" 
                        onclick="window.App.applyCartCoupon()"
                        class="bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold px-4 py-2 rounded-xl transition cursor-pointer"
                    >
                        Apply
                    </button>
                </div>
                <div id="cart-coupon-message" class="text-xs font-semibold hidden"></div>

                <!-- Price Breakdown -->
                <div class="space-y-1.5 text-xs text-slate-600 pt-1">
                    <div class="flex justify-between font-medium">
                        <span>Subtotal:</span>
                        <span id="cart-drawer-subtotal" class="font-bold text-slate-900">৳0</span>
                    </div>
                    <div id="cart-drawer-discount-row" class="flex justify-between font-medium text-emerald-600 hidden">
                        <span>Discount:</span>
                        <span id="cart-drawer-discount">-৳0</span>
                    </div>
                    <div class="flex justify-between font-medium">
                        <span>Estimated Shipping:</span>
                        <span class="text-slate-500">Calculated at Checkout</span>
                    </div>
                    <div class="border-t border-slate-200 pt-2 flex justify-between text-base font-extrabold text-slate-900">
                        <span>Total:</span>
                        <span id="cart-drawer-total" class="text-emerald-700 font-black">৳0</span>
                    </div>
                </div>

                <!-- Checkout Action Buttons -->
                <div class="grid grid-cols-1 gap-2 pt-1">
                    <a 
                        href="{{ route('checkout') }}" 
                        onclick="window.App.closeCart()"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-extrabold text-sm py-3.5 rounded-xl text-center transition shadow-lg shadow-emerald-600/25 flex items-center justify-center gap-2"
                    >
                        <span>Proceed to Checkout</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>
