@extends('layouts.app')

@section('title', 'How to Order - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Simple Step-by-Step</span>
        <h1 class="text-3xl font-black text-slate-900">How to Order on BikroyBD24</h1>
        <p class="text-xs text-slate-500">Ordering products on BikroyBD24 takes less than 60 seconds with our hassle-free 1-step checkout.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm text-center space-y-3">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 text-2xl flex items-center justify-center mx-auto font-black">
                1
            </div>
            <h3 class="font-extrabold text-sm text-slate-900">Choose Products</h3>
            <p class="text-xs text-slate-500 leading-relaxed">Browse through electronics, gadgets, and lifestyle items. Click "Add to Cart" or "Order Now".</p>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm text-center space-y-3">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 text-2xl flex items-center justify-center mx-auto font-black">
                2
            </div>
            <h3 class="font-extrabold text-sm text-slate-900">Enter Delivery Address</h3>
            <p class="text-xs text-slate-500 leading-relaxed">Fill in your name, 11-digit mobile number, full address, and select your district for exact shipping rate.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm text-center space-y-3">
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 text-2xl flex items-center justify-center mx-auto font-black">
                3
            </div>
            <h3 class="font-extrabold text-sm text-slate-900">Receive & Pay Cash</h3>
            <p class="text-xs text-slate-500 leading-relaxed">Our courier partner delivers to your doorstep. Inspect your parcel and pay Cash on Delivery.</p>
        </div>
    </div>
</div>
@endsection
