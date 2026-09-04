@extends('layouts.app')

@section('title', 'Product Catalog - BikroyBD24')

@section('content')
<div class="max-w-[1400px] mx-auto px-3 sm:px-4 py-6">
    
    <!-- Breadcrumb & Title -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 font-semibold mb-1">
                <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-400"></i>
                <span class="text-slate-900">Products Catalog</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900">
                @if(request('search'))
                    Search Results for: <span class="text-emerald-600">"{{ request('search') }}"</span>
                @elseif(request('category'))
                    Category: <span class="text-emerald-600">{{ ucfirst(request('category')) }}</span>
                @else
                    All Products Catalog
                @endif
            </h1>
            <p class="text-xs text-slate-500 mt-1">Showing {{ $products->total() }} premium products available in Bangladesh</p>
        </div>

        <!-- Sort Filter Controls -->
        <form action="{{ route('catalog') }}" method="GET" class="flex items-center gap-2 self-start sm:self-auto">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            
            <label class="text-xs font-bold text-slate-600 shrink-0">Sort By:</label>
            <select name="sort" onchange="this.form.submit()" class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs font-bold text-slate-800 focus:outline-none focus:border-emerald-600 shadow-sm">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rating</option>
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
            </select>
        </form>
    </div>

    <!-- Main Catalog Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <!-- Left Filter Sidebar -->
        <aside class="hidden lg:block space-y-6">
            
            <!-- Category Filter Box -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-sm">
                <h3 class="text-sm font-extrabold text-slate-900 mb-3 pb-2 border-b border-slate-100 flex items-center justify-between">
                    <span>Categories</span>
                    <a href="{{ route('catalog') }}" class="text-[11px] text-emerald-600 hover:underline font-bold">Reset</a>
                </h3>
                <ul class="space-y-1.5 text-xs font-semibold text-slate-700">
                    <li>
                        <a href="{{ route('catalog') }}" class="flex items-center justify-between p-2 rounded-xl transition {{ !request('category') ? 'bg-emerald-50 text-emerald-700 font-extrabold' : 'hover:bg-slate-50' }}">
                            <span>All Categories</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('catalog', ['category' => $cat->id]) }}" class="flex items-center justify-between p-2 rounded-xl transition {{ request('category') == $cat->id ? 'bg-emerald-50 text-emerald-700 font-extrabold' : 'hover:bg-slate-50' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-[10px] text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full font-bold">{{ $cat->count ?? '•' }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Price Range Filter Form -->
            <div class="bg-white rounded-3xl p-5 border border-slate-200/80 shadow-sm">
                <h3 class="text-sm font-extrabold text-slate-900 mb-3 pb-2 border-b border-slate-100">
                    Price Range (BDT)
                </h3>
                <form action="{{ route('catalog') }}" method="GET" class="space-y-3">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400">Min ৳</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs font-bold focus:bg-white focus:outline-none focus:border-emerald-600">
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400">Max ৳</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="10000" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-1.5 text-xs font-bold focus:bg-white focus:outline-none focus:border-emerald-600">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-bold text-xs py-2 rounded-xl transition">
                        Apply Filter
                    </button>
                </form>
            </div>

            <!-- Promo Banner inside Sidebar -->
            <div class="rounded-3xl bg-gradient-to-br from-emerald-600 to-teal-700 text-white p-5 shadow-md text-center space-y-2">
                <span class="text-[10px] font-black uppercase bg-amber-400 text-slate-900 px-2 py-0.5 rounded-full">Instant ৳500 Discount</span>
                <h4 class="font-extrabold text-sm text-white">Coupon: NEXABD500</h4>
                <p class="text-[11px] text-emerald-100">Apply during checkout for instant savings on orders above ৳4,999</p>
            </div>

        </aside>

        <!-- Right Product Grid -->
        <main class="lg:col-span-3">
            @if($products->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-sm space-y-4">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 text-3xl mx-auto">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">No products found</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto">We couldn't find any products matching your search criteria. Try removing some filters or search for something else.</p>
                    <a href="{{ route('catalog') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-6 py-2.5 rounded-xl inline-block transition">
                        Clear Filters
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-5">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8 flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif
        </main>

    </div>

</div>
@endsection
