@extends('layouts.admin')

@section('title', 'Manage Categories - BikroyBD24 Admin')
@section('page_title', 'Category Directory')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-white">Categories</h2>
            <p class="text-xs text-slate-400">Organize store departments and display order.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($categories as $cat)
            <div class="bg-slate-950 p-5 rounded-3xl border border-slate-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-slate-900 text-emerald-400 flex items-center justify-center text-lg border border-slate-800">
                        @if($cat->icon && str_contains($cat->icon, 'fa-'))
                            <i class="{{ $cat->icon }}"></i>
                        @else
                            <i class="fa-solid fa-layer-group"></i>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white">{{ $cat->name }}</h4>
                        <span class="text-[10px] text-slate-500">{{ $cat->products_count ?? $cat->count }} Products</span>
                    </div>
                </div>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $cat->active ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                    {{ $cat->active ? 'Active' : 'Hidden' }}
                </span>
            </div>
        @endforeach
    </div>
</div>
@endsection
