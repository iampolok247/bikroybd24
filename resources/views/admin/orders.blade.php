@extends('layouts.admin')

@section('title', 'Manage Orders - BikroyBD24 Admin')
@section('page_title', 'Order Management & Fulfillment')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-white">Customer Orders</h2>
            <p class="text-xs text-slate-400">Process fulfillment, assign courier delivery, and manage statuses.</p>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('admin.orders') }}" method="GET" class="flex flex-wrap items-center gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search name, phone, order #..."
                class="bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-emerald-500"
            >
            <select name="status" onchange="this.form.submit()" class="bg-slate-950 border border-slate-800 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-emerald-500">
                <option value="">All Statuses</option>
                <option value="Pending Confirmation" {{ request('status') == 'Pending Confirmation' ? 'selected' : '' }}>Pending Confirmation</option>
                <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Shipped" {{ request('status') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-900 border-b border-slate-800">
                    <tr>
                        <th class="p-3">Order Info</th>
                        <th class="p-3">Customer & Phone</th>
                        <th class="p-3">Delivery Address</th>
                        <th class="p-3">Total Amount</th>
                        <th class="p-3">Courier</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="p-3">
                                <span class="font-bold text-white block">{{ $order->orderNumber ?? $order->id }}</span>
                                <span class="text-[10px] text-slate-500">{{ $order->created_at ? $order->created_at->format('d M Y, h:i A') : 'Recent' }}</span>
                            </td>
                            <td class="p-3">
                                <strong class="text-white block">{{ $order->customerName }}</strong>
                                <span class="text-emerald-400 font-mono text-[11px]">{{ $order->phone }}</span>
                            </td>
                            <td class="p-3 max-w-xs">
                                <p class="text-slate-300 truncate">{{ $order->address }}</p>
                                <span class="text-[10px] text-slate-500 font-bold uppercase">{{ $order->district }}</span>
                            </td>
                            <td class="p-3 font-bold text-emerald-400 text-sm">
                                ৳{{ number_format($order->totalAmount ?? $order->total_amount, 0) }}
                                <span class="block text-[10px] text-slate-500 font-normal">({{ $order->paymentMethod }})</span>
                            </td>
                            <td class="p-3">
                                <span class="text-slate-300 font-bold block">{{ $order->courierName ?? 'Steadfast' }}</span>
                                <span class="text-[10px] text-emerald-400 font-mono">{{ $order->trackingNumber ?? 'Auto-Assigned' }}</span>
                            </td>
                            <td class="p-3">
                                <select 
                                    onchange="window.AdminApp.updateOrderStatus('{{ $order->id }}', this.value)"
                                    class="bg-slate-900 border border-slate-700 rounded-lg px-2 py-1 text-[11px] font-bold text-white focus:outline-none focus:border-emerald-500"
                                >
                                    <option value="Pending Confirmation" {{ $order->orderStatus == 'Pending Confirmation' ? 'selected' : '' }}>Pending</option>
                                    <option value="Confirmed" {{ $order->orderStatus == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="Processing" {{ $order->orderStatus == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Shipped" {{ $order->orderStatus == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->orderStatus == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order->orderStatus == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td class="p-3 text-right">
                                <a href="{{ route('order.success', $order->id) }}" target="_blank" class="text-slate-400 hover:text-white p-1.5 rounded-lg bg-slate-900 border border-slate-800 transition" title="Print Invoice">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>

</div>
@endsection
