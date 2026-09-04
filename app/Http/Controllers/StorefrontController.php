<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CmsContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorefrontController extends Controller
{
    public function getCmsSettings()
    {
        $cms = CmsContent::pluck('content', 'key')->toArray();
        return array_merge([
            'siteTitle' => 'BikroyBD24 - Bangladesh Premium Online Shopping',
            'logoUrl' => '/logo.png',
            'topBannerText' => '⚡ FLASH SALE ACTIVE: UP TO 70% OFF ON ELECTRONICS & GADGETS! FREE DELIVERY ON ORDERS OVER ৳3,000!',
            'hotline' => '+8801854288311',
            'email' => 'support@bikroybd24.com',
            'address' => 'Mirpur-10, Dhaka-1216, Bangladesh',
            'deliveryDhaka' => 70,
            'deliveryOutside' => 130,
            'searchPlaceholder' => 'Search 10,000+ products, brands and gadgets in Bangladesh...',
            'geminiApiKey' => env('GEMINI_API_KEY', ''),
        ], $cms);
    }

    public function home()
    {
        $categories = Category::where('active', true)->get();
        $flashSales = Product::where('is_flash_sale', true)
            ->orWhere('isFlashSale', true)
            ->orWhere('discount', '>', 10)
            ->take(8)
            ->get();
        $trendingProducts = Product::where('is_trending', true)
            ->orWhere('isTrending', true)
            ->take(12)
            ->get();
        if ($trendingProducts->isEmpty()) {
            $trendingProducts = Product::take(12)->get();
        }
        $featuredProducts = Product::where('is_featured', true)
            ->orWhere('isFeatured', true)
            ->take(12)
            ->get();
        $allProducts = Product::take(24)->get();
        $activeCoupon = Coupon::where('status', 'ACTIVE')->first();
        $cms = $this->getCmsSettings();

        return view('pages.home', compact(
            'categories',
            'flashSales',
            'trendingProducts',
            'featuredProducts',
            'allProducts',
            'activeCoupon',
            'cms'
        ));
    }

    public function catalog(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('categoryName', 'like', $term)
                  ->orWhere('sku', 'like', $term)
                  ->orWhere('description', 'like', $term);
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', floatval($request->min_price));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', floatval($request->max_price));
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('reviews', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(16)->withQueryString();
        $categories = Category::where('active', true)->get();
        $cms = $this->getCmsSettings();

        return view('pages.catalog', compact('products', 'categories', 'cms'));
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        $cms = $this->getCmsSettings();
        return view('pages.categories', compact('categories', 'cms'));
    }

    public function productDetail($id)
    {
        $product = Product::where('id', $id)->orWhere('sku', $id)->firstOrFail();
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
        $cms = $this->getCmsSettings();

        return view('pages.product-detail', compact('product', 'relatedProducts', 'cms'));
    }

    public function checkout()
    {
        $cms = $this->getCmsSettings();
        return view('pages.checkout', compact('cms'));
    }

    public function wishlist()
    {
        $cms = $this->getCmsSettings();
        return view('pages.wishlist', compact('cms'));
    }

    public function orderSuccess($orderId)
    {
        $order = Order::where('id', $orderId)->orWhere('orderNumber', $orderId)->firstOrFail();
        $cms = $this->getCmsSettings();
        return view('pages.order-success', compact('order', 'cms'));
    }

    public function orderTracking(Request $request)
    {
        $order = null;
        if ($request->filled('query')) {
            $query = trim($request->query('query'));
            $order = Order::where('id', $query)
                ->orWhere('orderNumber', $query)
                ->orWhere('phone', $query)
                ->first();
        }
        $cms = $this->getCmsSettings();
        return view('pages.order-tracking', compact('order', 'cms'));
    }

    // Static pages
    public function help() { return view('pages.static.help', ['cms' => $this->getCmsSettings()]); }
    public function howToOrder() { return view('pages.static.how-to-order', ['cms' => $this->getCmsSettings()]); }
    public function shipping() { return view('pages.static.shipping', ['cms' => $this->getCmsSettings()]); }
    public function returns() { return view('pages.static.returns', ['cms' => $this->getCmsSettings()]); }
    public function privacy() { return view('pages.static.privacy', ['cms' => $this->getCmsSettings()]); }
    public function terms() { return view('pages.static.terms', ['cms' => $this->getCmsSettings()]); }
}
