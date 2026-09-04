@extends('layouts.app')

@section('title', 'Help Center & Customer Support - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Customer Support</span>
        <h1 class="text-3xl font-black text-slate-900">How Can We Help You?</h1>
        <p class="text-xs text-slate-500">Find answers to frequently asked questions about orders, payments, shipping, and returns.</p>
    </div>

    <!-- FAQ Accordions -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-sm font-black text-slate-900 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-circle-question text-emerald-600"></i> How do I place an order?
            </h3>
            <p class="text-xs text-slate-600 leading-relaxed pl-6">Browse products, click "Add to Cart" or "Order Now", enter your delivery address and phone number, and confirm. No account registration is required!</p>
        </div>

        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-sm font-black text-slate-900 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-circle-question text-emerald-600"></i> What are the delivery charges?
            </h3>
            <p class="text-xs text-slate-600 leading-relaxed pl-6">Inside Dhaka City delivery is ৳70 (takes 24-48 hours). Outside Dhaka / nationwide delivery is ৳130 (takes 48-72 hours via Steadfast / Redx).</p>
        </div>

        <div class="border-b border-slate-100 pb-4">
            <h3 class="text-sm font-black text-slate-900 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-circle-question text-emerald-600"></i> Is Cash on Delivery (COD) supported?
            </h3>
            <p class="text-xs text-slate-600 leading-relaxed pl-6">Yes! 100% of our products support Cash on Delivery all across Bangladesh. You pay the rider upon inspecting the parcel box.</p>
        </div>

        <div>
            <h3 class="text-sm font-black text-slate-900 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-circle-question text-emerald-600"></i> How can I contact customer support?
            </h3>
            <p class="text-xs text-slate-600 leading-relaxed pl-6">You can call our hotline at <strong class="text-slate-900">{{ $cms['hotline'] ?? '+8801854288311' }}</strong>, chat on WhatsApp, or message our 24/7 Gemini AI Assistant on this website.</p>
        </div>
    </div>
</div>
@endsection
