@extends('layouts.app')

@section('title', 'Order Placed Successfully! - BikroyBD24')

@section('content')
<div class="max-w-[800px] mx-auto px-3 sm:px-4 py-12">
    
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200/80 shadow-xl text-center space-y-6">
        
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto shadow-inner">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="space-y-2">
            <span class="text-xs font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                Order Placed Successfully!
            </span>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900">
                Thank You, {{ $order->customerName }}!
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto">
                Your order has been received and is now being processed. Our team will contact you shortly to confirm the shipment.
            </p>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/80 text-left space-y-4">
            <div class="flex flex-wrap items-center justify-between gap-2 pb-4 border-b border-slate-200">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Order ID / Invoice #</span>
                    <h3 class="text-base font-black text-slate-900">{{ $order->orderNumber ?? $order->id }}</h3>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Order Status</span>
                    <span class="block text-xs font-black text-amber-600 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200">
                        {{ $order->orderStatus ?? 'Pending Confirmation' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5">Delivery Address:</span>
                    <p class="text-slate-800 font-bold">{{ $order->address }}, {{ $order->district }}</p>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5">Phone Number:</span>
                    <p class="text-slate-800 font-bold">{{ $order->phone }}</p>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5">Payment Method:</span>
                    <p class="text-slate-800 font-bold">{{ $order->paymentMethod }} ({{ $order->paymentStatus }})</p>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold block mb-0.5">Total Amount Payable:</span>
                    <p class="text-emerald-700 font-black text-base">৳{{ number_format($order->totalAmount ?? $order->total_amount, 0) }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons: Print & Continue Shopping -->
        <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
            <button onclick="window.print()" class="bg-slate-900 hover:bg-black text-white font-bold text-xs px-6 py-3 rounded-xl transition flex items-center gap-2 cursor-pointer shadow-md">
                <i class="fa-solid fa-print"></i>
                <span>Print Invoice</span>
            </button>
            <a href="{{ route('home') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs px-6 py-3 rounded-xl transition flex items-center gap-2 shadow-lg shadow-emerald-600/25">
                <i class="fa-solid fa-bag-shopping"></i>
                <span>Continue Shopping</span>
            </a>
        </div>

    </div>

</div>
@endsection
