@extends('layouts.app')

@section('title', 'BikroyBD24 - Bangladesh #1 Online Shopping Destination')

@section('content')
<div class="space-y-10 sm:space-y-14 py-4 sm:py-6">
    
    <!-- 1. Hero Carousel & Promo Banner Section -->
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-6 items-stretch">
            
            <!-- Main Hero Slider -->
            <div class="lg:col-span-8 rounded-3xl bg-gradient-to-br from-slate-900 via-teal-950 to-emerald-950 text-white p-6 sm:p-10 relative overflow-hidden shadow-xl flex flex-col justify-between min-h-[360px] sm:min-h-[440px]">
                
                <!-- Background decorative glow -->
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-xl space-y-4">
                    <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-3.5 py-1 rounded-full text-xs font-black tracking-wider uppercase">
                        <i class="fa-solid fa-sparkles text-amber-400"></i> Bangladesh Mega E-Commerce
                    </div>
                    <h1 class="text-3xl sm:text-5xl font-black tracking-tight leading-[1.15]">
                        Discover Next-Gen <span class="bg-gradient-to-r from-emerald-400 to-teal-200 bg-clip-text text-transparent">Smart Gadgets</span> & Lifestyle.
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-md">
                        Shop authentic wireless earbuds, smartwatches, fast chargers, and smart home tech with Cash on Delivery nationwide.
                    </p>
                </div>

                <div class="relative z-10 pt-6 flex flex-wrap items-center gap-3">
                    <a href="{{ route('catalog') }}" class="bg-emerald-500 hover:bg-emerald-400 active:scale-95 text-slate-950 font-black text-xs sm:text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-emerald-500/25 transition flex items-center gap-2">
                        <span>Explore Catalog</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('catalog', ['section' => 'flash_sale']) }}" class="bg-white/10 hover:bg-white/20 active:scale-95 text-white border border-white/20 font-bold text-xs sm:text-sm px-5 py-3.5 rounded-2xl transition flex items-center gap-2">
                        <i class="fa-solid fa-bolt text-amber-400"></i>
                        <span>Flash Deals</span>
                    </a>
                </div>

                <!-- Floating Badge in Hero -->
                <div class="hidden sm:block absolute right-8 bottom-8 bg-white/10 backdrop-blur-md border border-white/20 p-3.5 rounded-2xl text-center shadow-lg">
                    <span class="text-amber-400 text-xs font-black block">PROMO CODE</span>
                    <span class="text-white font-black text-sm tracking-wider">NEXABD500</span>
                    <span class="text-[10px] text-emerald-300 block">৳500 OFF</span>
                </div>

            </div>

            <!-- Right Promo Cards Column -->
            <div class="lg:col-span-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                
                <!-- Promo Card 1: Fast Delivery -->
                <div class="bg-gradient-to-br from-amber-500/10 via-white to-amber-50/50 rounded-3xl p-6 border border-amber-200/80 shadow-sm flex flex-col justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-700 bg-amber-100 px-2.5 py-0.5 rounded-full">Express Delivery</span>
                            <h3 class="text-base sm:text-lg font-black text-slate-900 mt-2">Cash on Delivery</h3>
                            <p class="text-xs text-slate-500 mt-1">24h inside Dhaka, 48h nationwide</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-truck-bolt"></i>
                        </div>
                    </div>
                    <div class="pt-4 flex items-center justify-between border-t border-amber-100 mt-3">
                        <span class="text-xs font-black text-slate-800">Dhaka: ৳70 | Outside: ৳130</span>
                        <a href="{{ route('page.shipping') }}" class="text-xs font-bold text-amber-700 hover:underline">Rates →</a>
                    </div>
                </div>

                <!-- Promo Card 2: AI Support & Trust -->
                <div class="bg-gradient-to-br from-emerald-500/10 via-white to-emerald-50/50 rounded-3xl p-6 border border-emerald-200/80 shadow-sm flex flex-col justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-100 px-2.5 py-0.5 rounded-full">Instant Assistance</span>
                            <h3 class="text-base sm:text-lg font-black text-slate-900 mt-2">Gemini AI Assistant</h3>
                            <p class="text-xs text-slate-500 mt-1">Chat live in Bangla or English</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                            <i class="fa-solid fa-robot"></i>
                        </div>
                    </div>
                    <div class="pt-4 flex items-center justify-between border-t border-emerald-100 mt-3">
                        <button onclick="window.App.toggleAiChat()" class="text-xs font-bold text-emerald-700 hover:underline cursor-pointer">Launch AI Chat →</button>
                        <span class="text-[10px] bg-emerald-600 text-white font-bold px-2 py-0.5 rounded-full">24/7 Live</span>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 2. Categories Explorer Grid -->
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Featured Collections</span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900">Explore by Category</h2>
            </div>
            <a href="{{ route('categories') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                <span>View All</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 sm:gap-4">
            @foreach($categories->take(6) as $cat)
                <a href="{{ route('catalog', ['category' => $cat->id]) }}" class="group bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 hover:border-emerald-500/50 p-4 text-center transition-all duration-300 hover:shadow-lg hover:-translate-y-1 flex flex-col items-center justify-center">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-slate-50 group-hover:bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl transition mb-3">
                        @if($cat->icon && str_contains($cat->icon, 'fa-'))
                            <i class="{{ $cat->icon }}"></i>
                        @elseif($cat->image)
                            <img src="{{ $cat->image }}" alt="{{ $cat->name }}" class="w-10 h-10 object-contain">
                        @else
                            <i class="fa-solid fa-layer-group"></i>
                        @endif
                    </div>
                    <h4 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-600 transition">{{ $cat->name }}</h4>
                    <span class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $cat->items_count ?? $cat->count ?? 'Browse Deals' }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- 3. Flash Sale Section with Countdown Timer -->
    @if($flashSales->isNotEmpty())
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4">
        <div class="bg-gradient-to-r from-rose-600 via-rose-500 to-amber-500 rounded-3xl p-5 sm:p-8 text-white shadow-xl shadow-rose-600/10">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/20">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl text-amber-300">
                        <i class="fa-solid fa-bolt animate-bounce"></i>
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black">Flash Deals & Mega Savings</h2>
                        <p class="text-xs text-rose-100 font-medium">Limited stock available at deep promotional discounts!</p>
                    </div>
                </div>

                <!-- Live Countdown Timer -->
                <div class="flex items-center gap-2 text-center" id="flash-sale-timer">
                    <div class="bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-xl">
                        <span id="fs-hours" class="text-sm sm:text-base font-black text-amber-400">12</span>
                        <span class="text-[9px] text-slate-300 block uppercase">Hours</span>
                    </div>
                    <span class="font-black text-lg">:</span>
                    <div class="bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-xl">
                        <span id="fs-minutes" class="text-sm sm:text-base font-black text-amber-400">45</span>
                        <span class="text-[9px] text-slate-300 block uppercase">Mins</span>
                    </div>
                    <span class="font-black text-lg">:</span>
                    <div class="bg-slate-950/60 backdrop-blur-md px-3 py-1.5 rounded-xl">
                        <span id="fs-seconds" class="text-sm sm:text-base font-black text-amber-400">30</span>
                        <span class="text-[9px] text-slate-300 block uppercase">Secs</span>
                    </div>
                </div>
            </div>

            <!-- Flash Products Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5 mt-6">
                @foreach($flashSales as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>

        </div>
    </section>
    @endif

    <!-- 4. Trending & Best Selling Products -->
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4" id="all-products">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Top Recommendations</span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900">Trending Gadgets & Accessories</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                <span>View Full Catalog</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
            @foreach($trendingProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <!-- 5. Promotional Promo Banner Grid -->
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            
            <div class="bg-gradient-to-r from-teal-800 to-emerald-900 rounded-3xl p-6 sm:p-8 text-white flex items-center justify-between shadow-md relative overflow-hidden">
                <div class="space-y-2 max-w-xs z-10">
                    <span class="bg-amber-400 text-slate-900 text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase">Special Offer</span>
                    <h3 class="text-xl font-black">True Wireless ANC Earbuds</h3>
                    <p class="text-xs text-emerald-200">Crisp Hi-Res audio with up to 40 hours battery.</p>
                    <div class="pt-2">
                        <a href="{{ route('catalog') }}" class="bg-white text-slate-900 hover:bg-emerald-100 font-bold text-xs px-4 py-2 rounded-xl inline-flex items-center gap-1.5 transition">
                            Shop Now →
                        </a>
                    </div>
                </div>
                <div class="text-7xl text-emerald-500/20 absolute right-4 bottom-2 pointer-events-none">
                    <i class="fa-solid fa-headphones"></i>
                </div>
            </div>

            <div class="bg-gradient-to-r from-slate-900 to-indigo-950 rounded-3xl p-6 sm:p-8 text-white flex items-center justify-between shadow-md relative overflow-hidden">
                <div class="space-y-2 max-w-xs z-10">
                    <span class="bg-indigo-500 text-white text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase">New Arrival</span>
                    <h3 class="text-xl font-black">Amoled Smartwatches</h3>
                    <p class="text-xs text-indigo-200">Bluetooth calling, health tracking & 100+ sports modes.</p>
                    <div class="pt-2">
                        <a href="{{ route('catalog') }}" class="bg-white text-slate-900 hover:bg-indigo-100 font-bold text-xs px-4 py-2 rounded-xl inline-flex items-center gap-1.5 transition">
                            Explore Smartwatches →
                        </a>
                    </div>
                </div>
                <div class="text-7xl text-indigo-500/20 absolute right-4 bottom-2 pointer-events-none">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>

        </div>
    </section>

    <!-- 6. Full Catalog Showcase Section -->
    <section class="max-w-[1400px] mx-auto px-3 sm:px-4">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Featured Inventory</span>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900">All Featured Products</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                <span>See All</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">
            @foreach($allProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

</div>
@endsection
