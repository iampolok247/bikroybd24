<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('products');

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('section')) {
            $query->where('section', $request->section);
        }

        if ($request->has('search') && !empty($request->search)) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('categoryName', 'like', $term)
                  ->orWhere('sku', 'like', $term);
            });
        }

        $products = $query->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|string',
        ]);

        $id = $request->id ?? 'p_' . time();
        $finalSku = $request->sku ?? 'SKU-' . substr(time(), -6);

        $data = [
            'id' => $id,
            'sku' => $finalSku,
            'barcode' => $request->barcode ?? '',
            'name' => $request->name,
            'title' => $request->title ?? $request->name,
            'category' => $request->category,
            'categoryName' => $request->categoryName ?? $request->category,
            'price' => floatval($request->price),
            'supplierCost' => floatval($request->supplierCost ?? ($request->price * 0.65)),
            'oldPrice' => $request->oldPrice ? floatval($request->oldPrice) : null,
            'original_price' => $request->oldPrice ? floatval($request->oldPrice) : null,
            'discount' => intval($request->discount ?? 0),
            'rating' => floatval($request->rating ?? 5.0),
            'reviews' => intval($request->reviews ?? 1),
            'image' => $request->image ?? 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80',
            'inStock' => intval($request->inStock ?? 10),
            'stock' => intval($request->inStock ?? 10),
            'totalStock' => intval($request->totalStock ?? 50),
            'minStockThreshold' => intval($request->minStockThreshold ?? 5),
            'section' => $request->section ?? 'catalog',
            'description' => $request->description ?? '',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('products')->updateOrInsert(['id' => $id], $data);

        DB::table('audit_logs')->insert([
            'userId' => 'admin',
            'userName' => 'Admin',
            'action' => 'CREATE_PRODUCT',
            'details' => "Created product {$request->name} (SKU: {$finalSku})",
            'ipAddress' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'id' => $id, 'sku' => $finalSku, 'product' => $data]);
    }

    public function update(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $updateData = [];
        if ($request->has('name')) $updateData['name'] = $request->name;
        if ($request->has('price')) $updateData['price'] = floatval($request->price);
        if ($request->has('oldPrice')) $updateData['oldPrice'] = floatval($request->oldPrice);
        if ($request->has('discount')) $updateData['discount'] = intval($request->discount);
        if ($request->has('inStock')) {
            $updateData['inStock'] = intval($request->inStock);
            $updateData['stock'] = intval($request->inStock);
        }
        if ($request->has('totalStock')) $updateData['totalStock'] = intval($request->totalStock);
        if ($request->has('minStockThreshold')) $updateData['minStockThreshold'] = intval($request->minStockThreshold);
        if ($request->has('category')) $updateData['category'] = $request->category;
        if ($request->has('section')) $updateData['section'] = $request->section;
        if ($request->has('description')) $updateData['description'] = $request->description;
        $updateData['updated_at'] = now();

        DB::table('products')->where('id', $id)->update($updateData);

        $updatedProduct = DB::table('products')->where('id', $id)->first();

        DB::table('audit_logs')->insert([
            'userId' => 'admin',
            'userName' => 'Admin',
            'action' => 'UPDATE_PRODUCT',
            'details' => "Updated product {$id}",
            'ipAddress' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'product' => $updatedProduct]);
    }

    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
