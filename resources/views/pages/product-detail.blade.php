@extends('layouts.app')

@section('title', $product->name . ' - BikroyBD24')

@section('content')
@php
    $discount = $product->discount ?? 0;
    if (!$discount && $product->oldPrice && $product->oldPrice > $product->price) {
        $discount = round((($product->oldPrice - $product->price) / $product->oldPrice) * 100);
    }
    $productJson = json_encode([
        'id' => (string)$product->id,
        'name' => $product->name,
        'price' => (float)$product->price,
        'oldPrice' => (float)($product->oldPrice ?? $product->price),
        'discount' => (int)$discount,
        'image' => $product->image,
        'category' => $product->categoryName ?? $product->category,
        'categoryName' => $product->categoryName ?? $product->category,
        'rating' => (float)($product->rating ?? 5.0),
        'reviews' => (int)($product->reviews ?? 15),
        'inStock' => (int)($product->inStock ?? 10),
        'description' => $product->description ?? '',
    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
@endphp

<div class="max-w-[1400px] mx-auto px-3 sm:px-4 py-6">
    
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-6">
        <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('catalog') }}" class="hover:text-emerald-600">Catalog</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <a href="{{ route('catalog', ['category' => $product->category]) }}" class="hover:text-emerald-600">{{ $product->categoryName ?? $product->category }}</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
        <span class="text-slate-900 truncate max-w-xs">{{ $product->name }}</span>
    </div>

    <!-- Main Product Grid Layout -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-8 shadow-sm grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Image Showcase -->
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100 flex items-center justify-center relative overflow-hidden aspect-square">
                @if($discount > 0)
                    <span class="absolute top-4 left-4 bg-rose-500 text-white text-xs font-black px-3 py-1 rounded-full shadow-sm">
                        -{{ $discount }}% OFF
                    </span>
                @endif
                <img 
                    src="{{ $product->image }}" 
                    alt="{{ $product->name }}" 
                    class="max-h-[380px] w-full object-contain mx-auto transition-transform duration-500 hover:scale-105"
                    onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80'"
                >
            </div>
            
            <div class="grid grid-cols-4 gap-2">
                <div class="border-2 border-emerald-500 rounded-2xl p-2 bg-slate-50 flex items-center justify-center cursor-pointer">
                    <img src="{{ $product->image }}" class="h-14 object-contain">
                </div>
            </div>
        </div>

        <!-- Right Product Summary & Actions -->
        <div class="lg:col-span-7 space-y-5">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                    {{ $product->categoryName ?? $product->category }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-3 leading-snug">
                    {{ $product->name }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-4 mt-3 text-xs">
                    <div class="flex items-center gap-1.5 text-amber-400">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star text-xs {{ $i <= round($product->rating ?? 5) ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                        <span class="text-slate-900 font-extrabold ml-1">{{ $product->rating ?? 5.0 }}</span>
                        <span class="text-slate-400">({{ $product->reviews ?? 15 }} verified reviews)</span>
                    </div>
                    <span class="text-slate-300">|</span>
                    <span class="text-slate-500 font-semibold">SKU: <strong class="text-slate-800">{{ $product->sku ?? 'BD24-'.$product->id }}</strong></span>
                </div>
            </div>

            <!-- Price Row -->
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200/80 flex items-baseline gap-4">
                <span class="text-3xl sm:text-4xl font-black text-slate-900">
                    ৳{{ number_format($product->price, 0) }}
                </span>
                @if($product->oldPrice && $product->oldPrice > $product->price)
                    <span class="text-lg text-slate-400 line-through font-semibold">
                        ৳{{ number_format($product->oldPrice, 0) }}
                    </span>
                    <span class="text-xs font-black text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-lg">
                        You save ৳{{ number_format($product->oldPrice - $product->price, 0) }}
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div class="text-xs sm:text-sm text-slate-600 leading-relaxed space-y-2">
                <p>{{ $product->description ?? 'Experience premium build quality and superior performance with this authentic branded gadget. Tested for high durability and optimal user satisfaction.' }}</p>
            </div>

            <!-- Delivery & Stock Info Box -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs">
                <div class="p-3 bg-emerald-50/50 rounded-xl border border-emerald-100 flex items-center gap-3">
                    <i class="fa-solid fa-truck-fast text-emerald-600 text-lg"></i>
                    <div>
                        <strong class="text-slate-900 block">Home Delivery</strong>
                        <span class="text-slate-500">Dhaka: ৳70 | Outside Dhaka: ৳130</span>
                    </div>
                </div>
                <div class="p-3 bg-amber-50/50 rounded-xl border border-amber-100 flex items-center gap-3">
                    <i class="fa-solid fa-hand-holding-dollar text-amber-600 text-lg"></i>
                    <div>
                        <strong class="text-slate-900 block">Cash on Delivery</strong>
                        <span class="text-slate-500">Pay after receiving the package</span>
                    </div>
                </div>
            </div>

            <!-- Quantity & Call-to-Actions -->
            <div class="space-y-3 pt-4 border-t border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="flex items-center border border-slate-300 rounded-2xl overflow-hidden bg-slate-50">
                        <button onclick="window.App.decrementProductDetailQty()" class="px-4 py-3 text-slate-700 hover:bg-slate-200 font-bold cursor-pointer text-sm">-</button>
                        <input type="number" id="detail-qty-input" value="1" min="1" max="99" class="w-14 text-center bg-transparent text-sm font-black focus:outline-none">
                        <button onclick="window.App.incrementProductDetailQty()" class="px-4 py-3 text-slate-700 hover:bg-slate-200 font-bold cursor-pointer text-sm">+</button>
                    </div>

                    <!-- Add to Cart Button -->
                    <button 
                        onclick="window.App.addProductDetailToCart({{ $productJson }})"
                        class="flex-1 bg-slate-900 hover:bg-black active:scale-95 text-white font-extrabold text-xs sm:text-sm py-3.5 px-6 rounded-2xl transition shadow-md flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>

                <!-- Instant Order Now (Direct Checkout) -->
                <button 
                    onclick="window.App.buyNowDirect({{ $productJson }})"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-black text-sm sm:text-base py-4 rounded-2xl transition shadow-xl shadow-emerald-600/30 flex items-center justify-center gap-2 cursor-pointer"
                >
                    <i class="fa-solid fa-bolt"></i>
                    <span>Order Now (Cash on Delivery)</span>
                </button>
            </div>

        </div>

    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
        <div class="mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-2xl font-black text-slate-900">Related Products</h2>
                <a href="{{ route('catalog', ['category' => $product->category]) }}" class="text-xs font-bold text-emerald-600 hover:underline">
                    View More in {{ $product->categoryName ?? $product->category }} →
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach($relatedProducts as $rel)
                    @include('partials.product-card', ['product' => $rel])
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
