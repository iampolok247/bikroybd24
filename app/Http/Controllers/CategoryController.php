<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->where('active', true)->get();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $id = $request->id ?? Str::slug($request->name);
        $data = [
            'id' => $id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'count' => $request->count ?? '0 Items',
            'items_count' => $request->count ?? '0 Items',
            'image' => $request->image ?? $request->logo ?? '',
            'banner' => $request->banner ?? '',
            'logo' => $request->logo ?? '',
            'icon' => $request->icon ?? '',
            'color' => $request->color ?? 'bg-slate-50 text-slate-700 border-slate-200',
            'desc' => $request->desc ?? $request->count ?? '',
            'active' => true,
            'showInTopCategories' => $request->showInTopCategories ?? true,
            'showInSidebar' => $request->showInSidebar ?? true,
            'type' => 'main',
            'level' => 'main',
            'created_at' => now(),
            'updated_at' => now()
        ];

        DB::table('categories')->updateOrInsert(['id' => $id], $data);

        return response()->json(['success' => true, 'category' => $data]);
    }
}
