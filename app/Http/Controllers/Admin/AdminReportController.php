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
        // ترتيب الأيام بالعربية (يبدأ من السبت، متوافق مع Laravel Carbon)
        $daysOfWeek = ['السبت','الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة'];

        // المبيعات لآخر 7 أيام (اليوم الحالي والست أيام السابقة)
        $salesPerDay = [];
        foreach ($daysOfWeek as $arabicDay) {
            $salesPerDay[$arabicDay] = 0;
        }

        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $orders = Order::where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->get();

        // جمع المبيعات حسب اليوم العربي
        foreach ($orders as $order) {
            $dayName = Carbon::parse($order->created_at)->locale('ar')->dayName;
            // لو اليوم غير معرف في الترتيب الافتراضي (احتمال تغيّر في بعض اللغات)، تجاهله
            if (isset($salesPerDay[$dayName])) {
                $salesPerDay[$dayName] += $order->total;
            }
        }

        $labels = array_values($daysOfWeek);           // ['السبت', ...]
        $salesData = array_values($salesPerDay);       // [100, 200, ...]

        return view('admin.reports.index', compact('labels', 'salesData'));
    }
}
