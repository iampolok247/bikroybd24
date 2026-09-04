<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = DB::table('coupons')->where('status', 'ACTIVE')->get();
        return response()->json($coupons);
    }

    public function apply(Request $request)
    {
        $code = strtoupper(trim($request->code ?? $request->couponCode ?? ''));
        $subtotal = floatval($request->subtotal ?? $request->amount ?? 0);

        if (empty($code)) {
            return response()->json(['error' => 'Coupon code is required.'], 400);
        }

        $coupon = DB::table('coupons')
            ->where(DB::raw('UPPER(code)'), $code)
            ->where('status', 'ACTIVE')
            ->first();

        if (!$coupon) {
            return response()->json(['error' => 'Invalid or expired coupon code.'], 404);
        }

        if ($subtotal < $coupon->minSpend) {
            return response()->json([
                'error' => "Minimum order amount of ৳{$coupon->minSpend} required for code {$code}."
            ], 400);
        }

        $discount = floatval($coupon->discountValue ?? $coupon->discount_amount ?? 500);

        return response()->json([
            'success' => true,
            'code' => $coupon->code,
            'couponCode' => $coupon->code,
            'discountAmount' => $discount,
            'discount' => $discount,
            'headline' => $coupon->headline ?? "Save ৳{$discount} Instant Discount!",
            'subtext' => $coupon->subtext ?? $coupon->subtitle ?? '',
            'message' => "Coupon '{$coupon->code}' applied successfully!"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'discountAmount' => 'nullable|numeric',
            'discountValue' => 'nullable|numeric',
        ]);

        $code = strtoupper(trim($request->code));
        $id = $request->id ?? 'c_' . strtolower($code);
        $discount = floatval($request->discountAmount ?? $request->discountValue ?? $request->discount ?? 500);

        $data = [
            'id' => $id,
            'code' => $code,
            'discountType' => $request->discountType ?? 'flat',
            'discountValue' => $discount,
            'discount_amount' => $discount,
            'minSpend' => floatval($request->minSpend ?? 0),
            'usageLimit' => intval($request->usageLimit ?? 100),
            'badge' => $request->badge ?? 'EXCLUSIVE FLASH PROMO',
            'headline' => $request->headline ?? "Save ৳{$discount} Instant Discount!",
            'subtext' => $request->subtext ?? $request->subtitle ?? '',
            'subtitle' => $request->subtitle ?? $request->subtext ?? '',
            'status' => 'ACTIVE',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('coupons')->updateOrInsert(['id' => $id], $data);

        return response()->json(['success' => true, 'coupon' => $data]);
    }
}
