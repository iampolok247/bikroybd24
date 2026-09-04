@extends('layouts.app')

@section('title', 'Terms & Conditions - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Legal Agreement</span>
        <h1 class="text-3xl font-black text-slate-900">Terms & Conditions</h1>
        <p class="text-xs text-slate-500">Please review the terms governing orders, deliveries, and transactions on our platform.</p>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6 text-xs text-slate-600 leading-relaxed">
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">1. Order Confirmation</h3>
            <p>Placing an order constitutes an offer to purchase. Orders are officially confirmed once our verification representative validates phone details with the buyer.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">2. Pricing & Currency</h3>
            <p>All prices listed on BikroyBD24 are in Bangladeshi Taka (BDT / ৳) and inclusive of applicable taxes unless explicitly stated otherwise.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">3. Refusal of Delivery</h3>
            <p>If a Cash on Delivery order is refused without valid defect or notice, the customer account may be flagged in the national courier trust database for future shipments.</p>
        </div>
    </div>
</div>
@endsection
