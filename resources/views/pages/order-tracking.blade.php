@extends('layouts.app')

@section('title', 'Track Order & Courier Status - BikroyBD24')

@section('content')
<div class="max-w-[800px] mx-auto px-3 sm:px-4 py-10">
    
    <div class="text-center max-w-xl mx-auto mb-8 space-y-2">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
            Live Parcel Tracker
        </span>
        <h1 class="text-2xl sm:text-3xl font-black text-slate-900">Track Your Shipment</h1>
        <p class="text-xs text-slate-500">Enter your Order ID (BD24-XXXXXX) or the phone number used during checkout.</p>
    </div>

    <!-- Search Box -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md">
        <form action="{{ route('order.tracking') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
            <input 
                type="text" 
                name="query" 
                value="{{ request('query') }}" 
                placeholder="Enter Order ID or Phone Number..."
                required
                class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-xs sm:text-sm font-bold text-slate-900 focus:bg-white focus:outline-none focus:border-emerald-600 transition"
            >
            <button 
                type="submit" 
                class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-black text-xs sm:text-sm px-8 py-3.5 rounded-2xl shadow-lg shadow-emerald-600/20 transition flex items-center justify-center gap-2 cursor-pointer"
            >
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Track Order</span>
            </button>
        </form>
    </div>

    @if($order)
        <!-- Order Result Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md mt-6 space-y-6">
            <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Order Reference</span>
                    <h3 class="text-lg font-black text-slate-900">{{ $order->orderNumber ?? $order->id }}</h3>
                </div>
                <div>
                    <span class="text-xs font-black text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200">
                        {{ $order->orderStatus ?? 'Processing' }}
                    </span>
                </div>
            </div>

            <!-- Visual Progress Timeline -->
            <div class="py-4">
                <div class="grid grid-cols-4 gap-2 text-center relative">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center text-sm font-bold mx-auto shadow-md">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <span class="text-[11px] font-bold text-slate-900 block">Received</span>
                    </div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->orderStatus, ['Confirmed', 'Processing', 'Shipped', 'Delivered']) ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center text-sm font-bold mx-auto">
                            <i class="fa-solid fa-box-check"></i>
                        </div>
                        <span class="text-[11px] font-bold text-slate-900 block">Processing</span>
                    </div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-full {{ in_array($order->orderStatus, ['Shipped', 'Delivered']) ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center text-sm font-bold mx-auto">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <span class="text-[11px] font-bold text-slate-900 block">In Transit</span>
                    </div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-full {{ $order->orderStatus === 'Delivered' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center text-sm font-bold mx-auto">
                            <i class="fa-solid fa-hand-holding-box"></i>
                        </div>
                        <span class="text-[11px] font-bold text-slate-900 block">Delivered</span>
                    </div>
                </div>
            </div>

            <!-- Details Summary -->
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/60 text-xs space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-500">Customer Name:</span>
                    <strong class="text-slate-900">{{ $order->customerName }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Phone Number:</span>
                    <strong class="text-slate-900">{{ $order->phone }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Courier Partner:</span>
                    <strong class="text-emerald-700 font-bold">{{ $order->courierName ?? 'Steadfast Courier Ltd.' }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Total Payable:</span>
                    <strong class="text-slate-900 font-black text-sm">৳{{ number_format($order->totalAmount ?? $order->total_amount, 0) }}</strong>
                </div>
            </div>
        </div>
    @elseif(request('query'))
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 text-center mt-6 space-y-3">
            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl mx-auto">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-base font-bold text-slate-900">No Order Found</h3>
            <p class="text-xs text-slate-500">We could not locate an order matching "{{ request('query') }}". Please verify your phone number or Order ID.</p>
        </div>
    @endif

</div>
@endsection
