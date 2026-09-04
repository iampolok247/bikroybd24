@extends('layouts.app')

@section('title', 'Shipping & Delivery Rates - BikroyBD24')

@section('content')
<div class="max-w-[1000px] mx-auto px-3 sm:px-4 py-10 space-y-8">
    <div class="text-center space-y-2 max-w-xl mx-auto">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Nationwide Delivery</span>
        <h1 class="text-3xl font-black text-slate-900">Shipping & Delivery Rates</h1>
        <p class="text-xs text-slate-500">Transparent delivery timelines and affordable rates across all 64 districts in Bangladesh.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-city"></i>
                </div>
                <div>
                    <h3 class="font-black text-base text-slate-900">Inside Dhaka City</h3>
                    <span class="text-xs text-slate-400">Home Delivery Service</span>
                </div>
            </div>
            <div class="space-y-2 text-xs text-slate-600">
                <p class="flex justify-between font-bold"><span>Delivery Charge:</span> <strong class="text-slate-900 text-sm">৳70</strong></p>
                <p class="flex justify-between"><span>Delivery Timeline:</span> <span class="text-slate-800 font-semibold">24 - 48 Hours</span></p>
                <p class="flex justify-between"><span>Courier Partners:</span> <span class="text-slate-800 font-semibold">Steadfast, Pathao, Redx</span></p>
                <p class="flex justify-between"><span>Payment Method:</span> <span class="text-emerald-700 font-bold">Cash on Delivery</span></p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
            <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div>
                    <h3 class="font-black text-base text-slate-900">Outside Dhaka (Nationwide)</h3>
                    <span class="text-xs text-slate-400">All 64 Districts</span>
                </div>
            </div>
            <div class="space-y-2 text-xs text-slate-600">
                <p class="flex justify-between font-bold"><span>Delivery Charge:</span> <strong class="text-slate-900 text-sm">৳130</strong></p>
                <p class="flex justify-between"><span>Delivery Timeline:</span> <span class="text-slate-800 font-semibold">48 - 72 Hours</span></p>
                <p class="flex justify-between"><span>Courier Partners:</span> <span class="text-slate-800 font-semibold">Steadfast Courier, Sundarban</span></p>
                <p class="flex justify-between"><span>Payment Method:</span> <span class="text-emerald-700 font-bold">Cash on Delivery</span></p>
            </div>
        </div>
    </div>
</div>
@endsection
