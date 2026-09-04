<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\CmsContent;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminViewController extends Controller
{
    public function login()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Default admin check or database check
        if (($email === 'admin@bikroybd.com' || $email === 'admin@bikroybd24.com') && ($password === 'admin123' || $password === 'password123')) {
            session(['admin_logged_in' => true, 'admin_email' => $email, 'admin_name' => 'Super Administrator']);
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        }

        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            session(['admin_logged_in' => true, 'admin_email' => $user->email, 'admin_name' => $user->name]);
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Use admin@bikroybd24.com / admin123'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('totalAmount');
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('inStock', '<=', 'minStockThreshold')->count();
        $recentOrders = Order::latest()->take(8)->get();
        $pendingOrders = Order::where('orderStatus', 'like', '%Pending%')->count();
        $deliveredOrders = Order::where('orderStatus', 'like', '%Delivered%')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'lowStockCount',
            'recentOrders',
            'pendingOrders',
            'deliveredOrders'
        ));
    }

    public function products()
    {
        $products = Product::latest()->paginate(20);
        $categories = Category::all();
        return view('admin.products', compact('products', 'categories'));
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories', compact('categories'));
    }

    public function orders(Request $request)
    {
        $query = Order::query();
        if ($request->filled('status')) {
            $query->where('orderStatus', $request->status);
        }
        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function($q) use ($term) {
                $q->where('id', 'like', $term)
                  ->orWhere('orderNumber', 'like', $term)
                  ->orWhere('customerName', 'like', $term)
                  ->orWhere('phone', 'like', $term);
            });
        }
        $orders = $query->latest()->paginate(20)->withQueryString();
        return view('admin.orders', compact('orders'));
    }

    public function coupons()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons', compact('coupons'));
    }

    public function customers()
    {
        // Unique customers grouped by phone
        $customers = Order::select('phone', 'customerName', 'address', 'district', DB::raw('count(*) as total_orders'), DB::raw('sum(totalAmount) as total_spent'), DB::raw('max(created_at) as last_order_date'))
            ->groupBy('phone', 'customerName', 'address', 'district')
            ->orderBy('total_spent', 'desc')
            ->paginate(20);

        return view('admin.customers', compact('customers'));
    }

    public function cms()
    {
        $cmsList = CmsContent::all()->pluck('content', 'key')->toArray();
        return view('admin.cms', compact('cmsList'));
    }

    public function integrations()
    {
        $cmsList = CmsContent::all()->pluck('content', 'key')->toArray();
        return view('admin.integrations', compact('cmsList'));
    }

    public function auditLogs()
    {
        $logs = AuditLog::latest()->paginate(30);
        return view('admin.audit-logs', compact('logs'));
    }
}
