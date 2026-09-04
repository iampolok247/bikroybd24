@extends('layouts.admin')

@section('title', 'Manage Coupons - BikroyBD24 Admin')
@section('page_title', 'Discount Coupons & Promos')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-xl font-black text-white">Promo Coupons</h2>
        <p class="text-xs text-slate-400">Configure promotional voucher codes and minimum spend thresholds.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($coupons as $coupon)
            <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-sm space-y-3">
                <div class="flex items-center justify-between">
                    <span class="bg-emerald-500/20 text-emerald-400 font-mono font-black text-sm px-3 py-1 rounded-xl border border-emerald-500/30">
                        {{ $coupon->code }}
                    </span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $coupon->status === 'ACTIVE' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-slate-800 text-slate-500' }}">
                        {{ $coupon->status }}
                    </span>
                </div>
                <div>
                    <h4 class="font-extrabold text-white text-base">৳{{ number_format($coupon->discountValue ?? $coupon->discount_amount, 0) }} Instant Discount</h4>
                    <p class="text-xs text-slate-400 mt-1">Min Spend: ৳{{ number_format($coupon->minSpend, 0) }}</p>
                </div>
                <div class="pt-3 border-t border-slate-800/80 flex items-center justify-between text-[11px] text-slate-500">
                    <span>Usage: {{ $coupon->usageCount }} / {{ $coupon->usageLimit }}</span>
                    <span>{{ $coupon->badge ?? 'Flash Coupon' }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
