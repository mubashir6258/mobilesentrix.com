<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'low_stock_items' => Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count(),
            'new_registrations' => Order::whereDate('created_at', '>=', now()->subDays(30))->count(),
        ];

        $recent_orders = Order::with('user')->latest()->limit(10)->get();
        $popular_products = Product::with('category')->orderBy('reviews_count', 'desc')->limit(10)->get();
        $low_stock_products = Product::whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->with('category')
            ->orderBy('stock_quantity', 'asc')
            ->limit(10)
            ->get();

        // Sales data for last 7 days
        $salesData = [];
        $salesLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $salesLabels[] = $date->format('M d');
            $salesData[] = Order::whereDate('created_at', $date->format('Y-m-d'))
                ->where('status', 'completed')
                ->sum('total');
        }

        // Order status distribution
        $orderStatusData = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'refunded' => Order::where('status', 'refunded')->count(),
        ];

        return view('admin.dashboard', compact(
            'stats',
            'recent_orders',
            'popular_products',
            'low_stock_products',
            'salesData',
            'salesLabels',
            'orderStatusData'
        ));
    }
}
