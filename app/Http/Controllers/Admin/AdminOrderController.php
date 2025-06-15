<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index() {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }
    public function show(Order $order) {
        return view('admin.orders.show', compact('order'));
    }
    public function update(Request $request, Order $order) {
        $request->validate(['status' => 'required|in:pending,completed,canceled']);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'تم تحديث حالة الطلب!');
    }
}
