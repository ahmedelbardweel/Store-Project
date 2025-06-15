<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $usersCount = User::where('role', '!=', 'admin')->count();
        $reviewsCount = Review::count();
        $totalSales = Order::where('status', 'completed')->sum('total');
        $latestOrders = Order::latest()->take(5)->get();
        $latestProducts = Product::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'productsCount',
            'ordersCount',
            'usersCount',
            'reviewsCount',
            'totalSales',
            'latestOrders',
            'latestProducts' // ← هذا السطر ضروري!
        ));
    }
}
