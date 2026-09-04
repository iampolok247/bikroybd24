<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function stats()
    {
        $totalOrders = DB::table('orders')->count();
        $totalSales = DB::table('orders')->sum('totalAmount');
        $totalProducts = DB::table('products')->count();
        $lowStockCount = DB::table('products')->whereColumn('inStock', '<=', 'minStockThreshold')->count();
        $activeCoupons = DB::table('coupons')->where('status', 'ACTIVE')->count();

        return response()->json([
            'totalOrders' => $totalOrders,
            'totalSales' => floatval($totalSales),
            'totalProducts' => $totalProducts,
            'lowStockCount' => $lowStockCount,
            'activeCoupons' => $activeCoupons
        ]);
    }
}
