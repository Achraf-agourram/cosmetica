<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        return response()->json([
            'sales' => $this->salesOverview(),
            'top_products' => $this->topProducts(),
            'sales_by_category' => $this->salesByCategory(),
            'orders_by_status' => $this->ordersByStatus(),
            'revenue_per_month' => $this->revenuePerMonth(),
        ]);
    }

    private function salesOverview()
    {
        $stats = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled'])
            ->selectRaw('
                COUNT(DISTINCT orders.id) AS total_orders,
                SUM(order_items.quantity) AS total_items_sold,
                SUM(order_items.quantity * order_items.price) AS total_revenue
            ')
            ->first();

        return [
            'total_orders' => $stats->total_orders,
            'total_items_sold' => $stats->total_items_sold,
            'total_revenue'    => round($stats->total_revenue, 2),
        ];
    }

    private function topProducts()
    {
        return DB::table('order_items')->join('orders', 'orders.id', '=', 'order_items.order_id')->join('products', 'products.id', '=', 'order_items.product_id')
            ->whereNotIn('orders.status', ['cancelled'])
            ->select(
                'products.name',
                'products.slug',
                DB::raw('SUM(order_items.quantity) AS total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) AS revenue')
            )
            ->groupBy('products.id', 'products.name', 'products.slug')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
    }

    private function salesByCategory()
    {
        return DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->whereNotIn('orders.status', ['cancelled'])
            ->select(
                'categories.name AS category',
                DB::raw('SUM(order_items.quantity) AS total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.price) AS revenue')
            )
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();
    }

    private function ordersByStatus()
    {
        return DB::table('orders')
            ->select('status', DB::raw('COUNT(*) AS total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();
    }

    private function revenuePerMonth()
    {
        return DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereNotIn('orders.status', ['cancelled'])
            ->whereYear('orders.created_at', now()->year)
            ->select(
                DB::raw('MONTH(orders.created_at) AS month'),
                DB::raw('SUM(order_items.quantity * order_items.price) AS revenue')
            )
            ->groupByRaw('MONTH(orders.created_at)')
            ->orderBy('month')
            ->get();
    }
}
