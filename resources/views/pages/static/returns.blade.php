@extends('layouts.app')

@section('title', 'Returns & Refunds Policy - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-rose-600 bg-rose-50 px-3 py-1 rounded-full">Hassle-Free Returns</span>
        <h1 class="text-3xl font-black text-slate-900">7 Days Return & Replacement Policy</h1>
        <p class="text-xs text-slate-500">Shop with complete peace of mind knowing you can return or replace any damaged or incorrect item.</p>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6 text-xs text-slate-600 leading-relaxed">
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">1. Eligibility for Return</h3>
            <p>You can request a replacement or return within 7 calendar days from the date of parcel delivery if the item is physically damaged upon opening, defective, missing parts, or significantly differs from the product description.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">2. Return Process</h3>
            <p>To initiate a return, contact our support hotline or WhatsApp at <strong class="text-slate-900">{{ $cms['hotline'] ?? '+8801854288311' }}</strong> with your Order ID and an unboxing video/photo of the item.</p>
        </div>
        <div>
            <h3 class="font-black text-sm text-slate-900 mb-2">3. Refund Processing</h3>
            <p>Once the returned parcel is received at our Dhaka fulfillment warehouse, refunds are disbursed within 24-48 business hours directly via bKash, Nagad, or Bank Transfer.</p>
        </div>
    </div>
</div>
@endsection
