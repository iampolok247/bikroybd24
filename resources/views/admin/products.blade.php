@extends('layouts.admin')

@section('title', 'Manage Products - BikroyBD24 Admin')
@section('page_title', 'Product Management')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-white">Product Inventory</h2>
            <p class="text-xs text-slate-400">Add, edit stock, adjust pricing, and toggle flash sales.</p>
        </div>
        <button onclick="window.AdminApp.openNewProductModal()" class="bg-emerald-600 hover:bg-emerald-500 text-slate-950 font-black text-xs px-4 py-2.5 rounded-xl transition flex items-center gap-2 cursor-pointer shadow-lg shadow-emerald-600/20">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Product</span>
        </button>
    </div>

    <!-- Products Table -->
    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-900 border-b border-slate-800">
                    <tr>
                        <th class="p-3">Product</th>
                        <th class="p-3">SKU</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Stock</th>
                        <th class="p-3">Badges</th>
                        <th class="p-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @foreach($products as $product)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="p-3 flex items-center gap-3">
                                <img src="{{ $product->image }}" class="w-10 h-10 object-contain rounded-lg bg-slate-900 p-1 border border-slate-800" onerror="this.src='/favicon.png'">
                                <div>
                                    <h4 class="font-bold text-white max-w-xs truncate">{{ $product->name }}</h4>
                                    <span class="text-[10px] text-slate-500">ID: {{ $product->id }}</span>
                                </div>
                            </td>
                            <td class="p-3 font-mono text-slate-400">{{ $product->sku ?? 'BD24-'.$product->id }}</td>
                            <td class="p-3">{{ $product->categoryName ?? $product->category }}</td>
                            <td class="p-3 font-bold text-emerald-400">৳{{ number_format($product->price, 0) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ $product->inStock > 5 ? 'bg-emerald-500/10 text-emerald-400' : 'bg-rose-500/10 text-rose-400' }}">
                                    {{ $product->inStock ?? $product->stock }} in stock
                                </span>
                            </td>
                            <td class="p-3">
                                @if($product->is_flash_sale || $product->isFlashSale)
                                    <span class="bg-amber-400/20 text-amber-300 text-[10px] font-bold px-2 py-0.5 rounded-md">Flash Sale</span>
                                @endif
                                @if($product->is_trending || $product->isTrending)
                                    <span class="bg-indigo-400/20 text-indigo-300 text-[10px] font-bold px-2 py-0.5 rounded-md">Trending</span>
                                @endif
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <button onclick="window.AdminApp.deleteProduct('{{ $product->id }}')" class="text-rose-400 hover:text-rose-300 transition cursor-pointer p-1">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>

</div>
@endsection
