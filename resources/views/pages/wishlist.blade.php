@extends('layouts.app')

@section('title', 'My Saved Wishlist - BikroyBD24')

@section('content')
<div class="max-w-[1400px] mx-auto px-3 sm:px-4 py-8">
    
    <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
        <div>
            <span class="text-xs font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-3 py-1 rounded-full">
                Saved Favorites
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2">My Wishlist</h1>
        </div>
        <button onclick="window.App.clearWishlist()" class="text-xs font-bold text-slate-400 hover:text-rose-600 transition cursor-pointer">
            Clear Wishlist
        </button>
    </div>

    <!-- Wishlist Grid Container -->
    <div id="wishlist-grid" class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Injected dynamically via JS -->
    </div>

    <!-- Empty State -->
    <div id="wishlist-empty-state" class="hidden bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-sm space-y-4 max-w-lg mx-auto my-12">
        <div class="w-20 h-20 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center text-3xl mx-auto">
            <i class="fa-regular fa-heart"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900">Your wishlist is empty</h3>
        <p class="text-xs text-slate-500">Explore our catalog and click the heart icon on any product to save it here for later.</p>
        <a href="{{ route('catalog') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-6 py-3 rounded-xl inline-block transition shadow-md">
            Browse Products
        </a>
    </div>

</div>
@endsection
