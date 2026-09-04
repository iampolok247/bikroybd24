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
        'reviews' => (int)($product->reviews ?? 12),
        'inStock' => (int)($product->inStock ?? 10),
        'description' => $product->description ?? '',
    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
@endphp

<div class="group bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 hover:border-emerald-500/40 p-3 sm:p-4 shadow-sm hover:shadow-xl hover:shadow-emerald-950/5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
    
    <!-- Top Badges & Wishlist Button -->
    <div class="flex items-center justify-between gap-1 mb-2 z-10">
        <div class="flex flex-wrap gap-1">
            @if($discount > 0)
                <span class="bg-rose-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-sm">
                    -{{ $discount }}%
                </span>
            @endif
            @if($product->is_flash_sale || $product->isFlashSale)
                <span class="bg-amber-400 text-slate-900 text-[10px] font-black px-2 py-0.5 rounded-full flex items-center gap-0.5">
                    <i class="fa-solid fa-bolt text-[9px]"></i> FLASH
                </span>
            @elseif($product->is_trending || $product->isTrending)
                <span class="bg-indigo-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                    TRENDING
                </span>
            @endif
        </div>

        <!-- Wishlist Button -->
        <button 
            onclick="window.App.toggleWishlist({{ $productJson }})"
            class="wishlist-btn-{{ $product->id }} w-8 h-8 rounded-full bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-400 flex items-center justify-center transition cursor-pointer"
            title="Add to Wishlist"
        >
            <i class="fa-regular fa-heart text-sm"></i>
        </button>
    </div>

    <!-- Product Image & Quick View Trigger -->
    <div class="relative w-full aspect-square bg-slate-50/80 rounded-xl sm:rounded-2xl overflow-hidden mb-3 flex items-center justify-center group-hover:bg-emerald-50/20 transition-colors">
        <a href="{{ route('product.detail', $product->id) }}" class="w-full h-full flex items-center justify-center p-2">
            <img 
                src="{{ $product->image }}" 
                alt="{{ $product->name }}" 
                loading="lazy"
                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500"
                onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500&q=80'"
            >
        </a>

        <!-- Quick View Overlay Button -->
        <button 
            onclick="window.App.openQuickView({{ $productJson }})"
            class="absolute bottom-2 left-1/2 -translate-x-1/2 bg-white/95 hover:bg-white text-slate-900 text-[11px] font-bold px-3 py-1.5 rounded-xl shadow-md backdrop-blur-sm opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-200 hidden sm:flex items-center gap-1.5 whitespace-nowrap cursor-pointer"
        >
            <i class="fa-solid fa-eye text-emerald-600"></i> Quick View
        </button>
    </div>

    <!-- Product Meta & Title -->
    <div class="flex-1 flex flex-col justify-between">
        <div>
            <span class="text-[10px] sm:text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">
                {{ $product->categoryName ?? $product->category ?? 'Gadget' }}
            </span>
            <a href="{{ route('product.detail', $product->id) }}" class="text-xs sm:text-sm font-bold text-slate-900 hover:text-emerald-700 transition line-clamp-2 leading-snug">
                {{ $product->name }}
            </a>
        </div>

        <!-- Rating Stars -->
        <div class="flex items-center gap-1.5 my-2">
            <div class="flex text-amber-400 text-[10px]">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa-solid fa-star {{ $i <= round($product->rating ?? 5) ? 'text-amber-400' : 'text-slate-200' }}"></i>
                @endfor
            </div>
            <span class="text-[10px] text-slate-400 font-bold">({{ $product->reviews ?? 15 }})</span>
        </div>

        <!-- Price & Add To Cart Button -->
        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2 mt-auto">
            <div>
                <div class="text-sm sm:text-base font-black text-slate-900">
                    ৳{{ number_format($product->price, 0) }}
                </div>
                @if($product->oldPrice && $product->oldPrice > $product->price)
                    <div class="text-[10px] sm:text-xs text-slate-400 line-through font-semibold">
                        ৳{{ number_format($product->oldPrice, 0) }}
                    </div>
                @endif
            </div>

            <!-- Instant Add to Cart Button -->
            <button 
                onclick="window.App.addToCart({{ $productJson }}, 1)"
                class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white w-9 h-9 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl flex items-center justify-center transition shadow-md shadow-emerald-600/20 hover:shadow-emerald-600/40 cursor-pointer shrink-0"
                title="Add to Cart"
                aria-label="Add {{ $product->name }} to Cart"
            >
                <i class="fa-solid fa-cart-plus text-xs sm:text-sm"></i>
            </button>
        </div>

    </div>

</div>
