<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



class CartController extends Controller
{
    // عرض السلة
    public function index(Request $request)
    {
        $key = 'cart_' . auth()->id();
        $cart = session()->get($key, []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('cart.index', compact('products', 'cart'));
    }

    // إضافة منتج للسلة
    public function add($id, Request $request)
    {
        $key = 'cart_' . auth()->id();
        $cart = session()->get($key, []);
        if(isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        session()->put($key, $cart);
        return redirect()->back()->with('success', 'The product has been added to the cart.');
    }

    public function remove($id)
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)->where('status', 'cart')->first();
        if (!$order) return back();

        $item = $order->items()->where('id', $id)->first();
        if ($item) {
            $item->delete();
            $order->total = $order->items()->sum(\DB::raw('quantity * price'));
            $order->save();
        }
        return back();
    }


    public function empty()
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)->where('status', 'cart')->first();
        if ($order) {
            $order->items()->delete();
            $order->total = 0;
            $order->save();
        }
        return redirect()->route('cart.show')->with('success', 'تم إفراغ السلة بنجاح!');
    }

    public function addToCart($productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        // البحث عن سلة (طلب) غير مكتملة لهذا المستخدم
        $order = Order::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'cart'],
            ['total' => 0]
        );

        // هل العنصر موجود سابقًا في السلة؟
        $orderItem = $order->items()->where('product_id', $product->id)->first();

        if ($orderItem) {
            // إذا كان موجود: زِد الكمية
            $orderItem->quantity += 1;
            $orderItem->save();
        } else {
            // إذا جديد: أضف كعنصر جديد
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // تحديث الإجمالي
        $order->total = $order->items()->sum(\DB::raw('quantity * price'));
        $order->save();

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة بنجاح!');
    }

    public function cart()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('status', 'cart')->first();

        $orderItems = $order ? $order->items()->with('product')->get() : collect();
        $total = $order ? $order->total : 0;

        return view('cart.index', compact('orderItems', 'total'));
    }
    public function showCart()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('status', 'cart')->first();

        $orderItems = $order ? $order->items()->with('product')->get() : collect();
        $total = $order ? $order->total : 0;

        return view('cart.index', compact('orderItems', 'total'));
    }

    public function increase($id)
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)->where('status', 'cart')->first();
        if (!$order) return back();

        $item = $order->items()->where('id', $id)->first();
        if ($item) {
            $item->quantity++;
            $item->save();
            $order->total = $order->items()->sum(\DB::raw('quantity * price'));
            $order->save();
        }
        return back();
    }

    public function decrease($id)
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)->where('status', 'cart')->first();
        if (!$order) return back();

        $item = $order->items()->where('id', $id)->first();
        if ($item && $item->quantity > 1) {
            $item->quantity--;
            $item->save();
            $order->total = $order->items()->sum(\DB::raw('quantity * price'));
            $order->save();
        }
        return back();
    }

    public function checkout()
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)->where('status', 'cart')->first();

        if (!$order || $order->items()->count() == 0) {
            return redirect()->route('cart.show')->with('error', 'السلة فارغة!');
        }

        // تغيير حالة الطلب
        $order->status = 'pending'; // أو 'completed' إذا أردت
        $order->save();

        // بإمكانك هنا إضافة منطق إرسال إشعار أو بريد للمستخدم أو إدارة الطلب

        return redirect()->route('cart.show')->with('success', 'تم إكمال الطلب بنجاح! سنقوم بمعالجة طلبك قريبًا.');
    }

    public function ordersHistory()
    {
        $user = auth()->user();
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->where('status', '!=', 'cart') // نستثني السلة الحالية
            ->orderByDesc('created_at')
            ->get();

        return view('cart.orders_history', compact('orders'));
    }

    public function showOrder($id)
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)
            ->where('id', $id)
            ->where('status', '!=', 'cart')
            ->with('items.product')
            ->firstOrFail();

        return view('cart.order_details', compact('order'));
    }


    public function downloadInvoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        // يمكنك إنشاء Blade جديد للفاتورة مثلاً: resources/views/orders/invoice.blade.php
        $pdf = Pdf::loadView('orders.invoice', compact('order'));
        $filename = "invoice_order_{$order->id}.pdf";

        return $pdf->download($filename);
    }


}
