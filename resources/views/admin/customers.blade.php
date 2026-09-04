@extends('layouts.admin')

@section('title', 'Manage Customers - BikroyBD24 Admin')
@section('page_title', 'Customer Directory')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-xl font-black text-white">Customer Base</h2>
        <p class="text-xs text-slate-400">Order frequency and lifetime value of buyers.</p>
    </div>

    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-900 border-b border-slate-800">
                    <tr>
                        <th class="p-3">Customer Name</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">District & Address</th>
                        <th class="p-3">Total Orders</th>
                        <th class="p-3">Lifetime Spent</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @forelse($customers as $c)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="p-3 font-bold text-white">{{ $c->customerName }}</td>
                            <td class="p-3 text-emerald-400 font-mono">{{ $c->phone }}</td>
                            <td class="p-3 max-w-xs truncate">{{ $c->address }} ({{ $c->district }})</td>
                            <td class="p-3 font-bold text-white">{{ $c->total_orders }} orders</td>
                            <td class="p-3 font-bold text-emerald-400">৳{{ number_format($c->total_spent, 0) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500">No customer history available yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
