<footer class="bg-slate-900 text-slate-300 border-t border-slate-800 pt-12 pb-24 lg:pb-12 text-xs">
    
    <!-- Trust Badges Section -->
    <div class="max-w-[1400px] mx-auto px-4 pb-12 border-b border-slate-800">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <div class="flex flex-col items-center p-4 rounded-2xl bg-slate-800/40 border border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-2xl mb-3">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <h4 class="font-extrabold text-sm text-white mb-1">Fast Delivery</h4>
                <p class="text-slate-400 text-[11px]">24-48 Hours all over Bangladesh</p>
            </div>

            <div class="flex flex-col items-center p-4 rounded-2xl bg-slate-800/40 border border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-2xl mb-3">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <h4 class="font-extrabold text-sm text-white mb-1">Cash on Delivery</h4>
                <p class="text-slate-400 text-[11px]">Pay when you receive the product</p>
            </div>

            <div class="flex flex-col items-center p-4 rounded-2xl bg-slate-800/40 border border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-2xl mb-3">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="font-extrabold text-sm text-white mb-1">100% Authentic</h4>
                <p class="text-slate-400 text-[11px]">Genuine branded products guaranteed</p>
            </div>

            <div class="flex flex-col items-center p-4 rounded-2xl bg-slate-800/40 border border-slate-800">
                <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 flex items-center justify-center text-2xl mb-3">
                    <i class="fa-solid fa-rotate-left"></i>
                </div>
                <h4 class="font-extrabold text-sm text-white mb-1">Easy 7 Days Return</h4>
                <p class="text-slate-400 text-[11px]">Hassle-free replacement policy</p>
            </div>

        </div>
    </div>

    <!-- Main Footer Columns -->
    <div class="max-w-[1400px] mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
            
            <!-- Brand Column -->
            <div class="lg:col-span-2 space-y-4">
                <a href="{{ route('home') }}" class="inline-block">
                    <img 
                        src="{{ asset($cms['logoUrl'] ?? 'logo.png') }}" 
                        alt="BikroyBD24" 
                        class="h-10 sm:h-12 w-auto object-contain brightness-0 invert"
                        onerror="this.src='/logo.png'"
                    >
                </a>
                <p class="text-slate-400 text-xs leading-relaxed max-w-sm">
                    BikroyBD24 is your trusted multi-category online shopping platform in Bangladesh, offering top gadgets, electronics, and lifestyle products with unmatched reliability.
                </p>
                <div class="space-y-2 text-xs text-slate-300">
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-emerald-500 w-4"></i>
                        <span>{{ $cms['address'] ?? 'Mirpur-10, Dhaka-1216, Bangladesh' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-emerald-500 w-4"></i>
                        <a href="tel:{{ $cms['hotline'] ?? '+8801854288311' }}" class="hover:text-emerald-400 font-bold">
                            {{ $cms['hotline'] ?? '+8801854288311' }}
                        </a>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-emerald-500 w-4"></i>
                        <span>{{ $cms['email'] ?? 'support@bikroybd24.com' }}</span>
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-3">
                <h4 class="text-sm font-extrabold text-white uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition">Home</a></li>
                    <li><a href="{{ route('catalog') }}" class="hover:text-emerald-400 transition">All Products</a></li>
                    <li><a href="{{ route('categories') }}" class="hover:text-emerald-400 transition">Shop by Category</a></li>
                    <li><a href="{{ route('catalog', ['section' => 'flash_sale']) }}" class="hover:text-emerald-400 transition">Flash Sales</a></li>
                    <li><a href="{{ route('wishlist') }}" class="hover:text-emerald-400 transition">My Wishlist</a></li>
                    <li><a href="javascript:void(0)" onclick="window.App.openTrackingModal()" class="hover:text-emerald-400 transition">Track Your Order</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div class="space-y-3">
                <h4 class="text-sm font-extrabold text-white uppercase tracking-wider">Customer Care</h4>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <li><a href="{{ route('page.help') }}" class="hover:text-emerald-400 transition">Help Center & FAQ</a></li>
                    <li><a href="{{ route('page.how-to-order') }}" class="hover:text-emerald-400 transition">How to Place Order</a></li>
                    <li><a href="{{ route('page.shipping') }}" class="hover:text-emerald-400 transition">Shipping & Delivery Rates</a></li>
                    <li><a href="{{ route('page.returns') }}" class="hover:text-emerald-400 transition">Returns & Refund Policy</a></li>
                    <li><a href="{{ route('page.privacy') }}" class="hover:text-emerald-400 transition">Privacy Policy</a></li>
                    <li><a href="{{ route('page.terms') }}" class="hover:text-emerald-400 transition">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Admin & Payment -->
            <div class="space-y-3">
                <h4 class="text-sm font-extrabold text-white uppercase tracking-wider">Payment & Admin</h4>
                <p class="text-[11px] text-slate-400">Accepted payment methods in Bangladesh:</p>
                <div class="flex flex-wrap gap-2 text-slate-200">
                    <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700 text-[10px] font-bold">Cash on Delivery</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700 text-[10px] font-bold text-pink-400">bKash</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700 text-[10px] font-bold text-orange-400">Nagad</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded-md border border-slate-700 text-[10px] font-bold text-purple-400">Rocket</span>
                </div>
                <div class="pt-3">
                    <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-1.5 text-xs text-emerald-400 hover:text-emerald-300 font-bold bg-slate-800/80 hover:bg-slate-800 px-3 py-1.5 rounded-xl border border-slate-700 transition">
                        <i class="fa-solid fa-lock"></i> Store Admin Portal
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Copyright -->
    <div class="max-w-[1400px] mx-auto px-4 pt-8 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
        <p>© {{ date('Y') }} BikroyBD24. All Rights Reserved. Powered by Laravel 11.</p>
        <div class="flex items-center gap-4 text-slate-400 text-base">
            <a href="#" class="hover:text-emerald-400 transition"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="hover:text-emerald-400 transition"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="hover:text-emerald-400 transition"><i class="fa-brands fa-youtube"></i></a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $cms['hotline'] ?? '8801854288311') }}" class="hover:text-emerald-400 transition"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
    </div>

</footer>
