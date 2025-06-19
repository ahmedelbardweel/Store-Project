<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;


class AdminReportController extends Controller
{
    public function sales() {
        $completedOrders = Order::where('status', 'completed')->get();
        $totalSales = $completedOrders->sum('total');
        $ordersCount = $completedOrders->count();
        // يمكنك هنا إضافة حساب الأرباح/الخسائر/تحليل المبيعات
        return view('admin.reports.sales', compact('totalSales', 'ordersCount', 'completedOrders'));
    }
    public function index()
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        $orders = Order::where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->get()
            ->groupBy(function($order) {
                return Carbon::parse($order->created_at)->format('Y-m-d');
            });

        $labels = [];
        $salesData = [];

        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::parse($startDate)->addDays($i);
            $dateStr = $date->format('Y-m-d');
            $dayName = $date->locale('ar')->isoFormat('dddd');

            $labels[] = $dayName . ' (' . $date->format('d/m') . ')';
            $salesData[] = isset($orders[$dateStr]) ? $orders[$dateStr]->sum('total') : 0;
        }

        // أرسل البيانات للواجهة
        return view('admin.reports.index', compact('labels', 'salesData'));
    }}
