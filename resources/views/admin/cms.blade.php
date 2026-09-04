@extends('layouts.admin')

@section('title', 'CMS & Banner Manager - BikroyBD24 Admin')
@section('page_title', 'Content Management & Banners')

@section('content')
<div class="space-y-6 max-w-4xl">
    <div>
        <h2 class="text-xl font-black text-white">CMS Settings</h2>
        <p class="text-xs text-slate-400">Update store notices, banners, support hotline and contact addresses.</p>
    </div>

    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 sm:p-8 shadow-sm space-y-6">
        
        <div>
            <label class="block text-xs font-bold text-slate-300 mb-1.5">Top Announcement Bar Text</label>
            <input 
                type="text" 
                id="cms-topBannerText"
                value="{{ $cmsList['topBannerText'] ?? '⚡ FLASH SALE ACTIVE: UP TO 70% OFF ON ELECTRONICS & GADGETS! FREE DELIVERY OVER ৳3,000!' }}" 
                class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition"
            >
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Support Hotline Phone</label>
                <input 
                    type="text" 
                    id="cms-hotline"
                    value="{{ $cmsList['hotline'] ?? '+8801854288311' }}" 
                    class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition"
                >
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-300 mb-1.5">Support Email Address</label>
                <input 
                    type="email" 
                    id="cms-email"
                    value="{{ $cmsList['email'] ?? 'support@bikroybd24.com' }}" 
                    class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition"
                >
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-300 mb-1.5">Store Physical Address</label>
            <input 
                type="text" 
                id="cms-address"
                value="{{ $cmsList['address'] ?? 'Mirpur-10, Dhaka-1216, Bangladesh' }}" 
                class="w-full bg-slate-900 border border-slate-700 rounded-2xl px-4 py-3 text-xs text-white focus:outline-none focus:border-emerald-500 transition"
            >
        </div>

        <div class="pt-4 border-t border-slate-800 flex justify-end">
            <button 
                onclick="window.AdminApp.saveCmsSettings()"
                class="bg-emerald-600 hover:bg-emerald-500 active:scale-95 text-slate-950 font-black text-xs px-6 py-3 rounded-xl transition shadow-md cursor-pointer"
            >
                Save CMS Changes
            </button>
        </div>

    </div>
</div>
@endsection
