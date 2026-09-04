@extends('layouts.app')

@section('title', 'Browse All Categories - BikroyBD24')

@section('content')
<div class="max-w-[1400px] mx-auto px-3 sm:px-4 py-8">
    
    <div class="text-center max-w-2xl mx-auto mb-10 space-y-2">
        <span class="text-xs font-black uppercase tracking-wider text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
            Department Directory
        </span>
        <h1 class="text-3xl sm:text-4xl font-black text-slate-900">Explore All Product Categories</h1>
        <p class="text-xs sm:text-sm text-slate-500">Find exactly what you need by browsing our curated e-commerce departments in Bangladesh.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($categories as $cat)
            <div class="group bg-white rounded-3xl border border-slate-200/80 hover:border-emerald-500/50 p-6 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-50 group-hover:bg-emerald-600 text-emerald-600 group-hover:text-white flex items-center justify-center text-2xl transition duration-300 shadow-sm">
                            @if($cat->icon && str_contains($cat->icon, 'fa-'))
                                <i class="{{ $cat->icon }}"></i>
                            @elseif($cat->image)
                                <img src="{{ $cat->image }}" alt="{{ $cat->name }}" class="w-8 h-8 object-contain">
                            @else
                                <i class="fa-solid fa-cube"></i>
                            @endif
                        </div>
                        <span class="text-xs font-bold bg-slate-100 group-hover:bg-emerald-100 group-hover:text-emerald-800 text-slate-600 px-3 py-1 rounded-full transition">
                            {{ $cat->products_count ?? $cat->count ?? 'Items' }} Items
                        </span>
                    </div>

                    <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-700 transition">
                        {{ $cat->name }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                        {{ $cat->desc ?? 'Explore top trending gadgets, accessories, and best-value products.' }}
                    </p>
                </div>

                <div class="pt-5 border-t border-slate-100 mt-4">
                    <a href="{{ route('catalog', ['category' => $cat->id]) }}" class="w-full bg-slate-50 hover:bg-emerald-600 group-hover:bg-emerald-600 group-hover:text-white text-slate-700 font-bold text-xs py-2.5 rounded-xl transition flex items-center justify-center gap-2">
                        <span>Browse Category</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
