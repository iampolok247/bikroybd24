@extends('layouts.admin')

@section('title', 'Admin Dashboard - BikroyBD24')
@section('page_title', 'Analytics & Overview')

@section('content')
<div class="space-y-8">
    
    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400">Total Revenue</span>
                <h3 class="text-2xl font-black text-white">৳{{ number_format($totalRevenue, 0) }}</h3>
                <span class="text-[10px] text-emerald-400 font-bold flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +14.8% this month
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-bangladeshi-taka-sign"></i>
            </div>
        </div>

        <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400">Total Orders</span>
                <h3 class="text-2xl font-black text-white">{{ $totalOrders }}</h3>
                <span class="text-[10px] text-amber-400 font-bold">{{ $pendingOrders }} Pending Confirmation</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400">Active Products</span>
                <h3 class="text-2xl font-black text-white">{{ $totalProducts }}</h3>
                <span class="text-[10px] text-slate-500">In 12 Categories</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <div class="bg-slate-950 p-6 rounded-3xl border border-slate-800 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-bold text-slate-400">Low Stock Alert</span>
                <h3 class="text-2xl font-black text-rose-400">{{ $lowStockCount }}</h3>
                <span class="text-[10px] text-rose-400 font-bold">Needs restock</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
        </div>

    </div>

    <!-- Recent Orders Table -->
    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 shadow-sm space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-base font-black text-white">Recent Customer Orders</h3>
            <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-emerald-400 hover:underline">
                View All Orders →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-900 border-b border-slate-800">
                    <tr>
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">District</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="p-3 font-bold text-white">{{ $order->orderNumber ?? $order->id }}</td>
                            <td class="p-3">{{ $order->customerName }}</td>
                            <td class="p-3">{{ $order->phone }}</td>
                            <td class="p-3">{{ $order->district }}</td>
                            <td class="p-3 font-bold text-emerald-400">৳{{ number_format($order->totalAmount ?? $order->total_amount, 0) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                    {{ $order->orderStatus ?? 'Pending' }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.orders', ['search' => $order->id]) }}" class="text-xs text-emerald-400 hover:underline font-bold">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-slate-500">No orders recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
