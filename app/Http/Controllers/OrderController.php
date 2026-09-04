<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        $items = DB::table('order_items')->where('orderId', $id)->get();
        $order->items_list = $items;
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'totalAmount' => 'nullable|numeric',
            'total_amount' => 'nullable|numeric',
        ]);

        $orderId = 'ORD-' . rand(1000, 9999);
        $orderNumber = $request->orderNumber ?? 'BD24-' . time();
        $subtotal = floatval($request->subtotal ?? 0);
        $totalAmount = floatval($request->totalAmount ?? $request->total_amount ?? $subtotal + 70);

        $orderData = [
            'id' => $orderId,
            'orderNumber' => $orderNumber,
            'customerName' => $request->customerName,
            'phone' => $request->phone,
            'email' => $request->email ?? '',
            'address' => $request->address,
            'district' => $request->district ?? 'Dhaka',
            'paymentMethod' => $request->paymentMethod ?? 'COD',
            'paymentStatus' => $request->paymentStatus ?? 'Unpaid',
            'deliveryCharge' => floatval($request->deliveryCharge ?? 70),
            'subtotal' => $subtotal,
            'totalAmount' => $totalAmount,
            'total_amount' => $totalAmount,
            'supplierTotalCost' => floatval($totalAmount * 0.65),
            'resellerProfit' => floatval($totalAmount * 0.35),
            'orderStatus' => 'Pending Confirmation',
            'status' => 'Pending',
            'courierName' => $request->courierName ?? 'Steadfast',
            'trackingNumber' => 'TRK-' . rand(100000, 999999),
            'fraudFlag' => 'Normal',
            'notes' => $request->notes ?? '',
            'items' => json_encode($request->items ?? []),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('orders')->insert($orderData);

        if ($request->has('items') && is_array($request->items)) {
            foreach ($request->items as $item) {
                DB::table('order_items')->insert([
                    'orderId' => $orderId,
                    'productId' => $item['id'] ?? 'p_0',
                    'productName' => $item['name'] ?? 'Product',
                    'price' => floatval($item['price'] ?? 0),
                    'supplierCost' => floatval(($item['price'] ?? 0) * 0.65),
                    'quantity' => intval($item['quantity'] ?? 1),
                    'image' => $item['image'] ?? '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        DB::table('audit_logs')->insert([
            'userId' => 'customer',
            'userName' => $request->customerName,
            'action' => 'PLACE_ORDER',
            'details' => "Order {$orderId} placed for ৳{$totalAmount}",
            'ipAddress' => $request->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'orderId' => $orderId,
            'id' => $orderId,
            'orderNumber' => $orderNumber,
            'totalAmount' => $totalAmount,
            'order' => $orderData
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $updateData = [];
        if ($request->has('status')) {
            $updateData['status'] = $request->status;
            $updateData['orderStatus'] = $request->status;
        }
        if ($request->has('orderStatus')) {
            $updateData['orderStatus'] = $request->orderStatus;
            $updateData['status'] = $request->orderStatus;
        }
        if ($request->has('paymentStatus')) $updateData['paymentStatus'] = $request->paymentStatus;
        $updateData['updated_at'] = now();

        DB::table('orders')->where('id', $id)->update($updateData);

        return response()->json(['success' => true]);
    }
}
