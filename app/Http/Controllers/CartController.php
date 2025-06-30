<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;



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
        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        session()->put($key, $cart);

        // AJAX RESPONSE
        if ($request->ajax()) {
            $cartCount = array_sum($cart);
            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'message' => 'The product has been added to the cart.'
            ]);
        }

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

//    السلة
    public function cart()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('status', 'cart')->first();

        $orderItems = $order ? $order->items()->with('product')->get() : collect();
        $total = $order ? $order->total : 0;

        return view('cart.index', compact('orderItems', 'total'));
    }

// اضافة الى السلة
    public function addToCart($productId, Request $request)
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
            $orderItem->quantity += 1;
            $orderItem->save();
        } else {
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // تحديث الإجمالي
        $order->total = $order->items()->sum(\DB::raw('quantity * price'));
        $order->save();

        // AJAX RESPONSE
        if ($request->ajax()) {
            $cartCount = $order->items()->sum('quantity');
            return response()->json([
                'success' => true,
                'cart_count' => $cartCount,
                'message' => 'The product has been added to the cart.'
            ]);
        }

        // Redirect عادي إذا ليس AJAX
        return redirect()->back()->with('success', 'The product has been added to the cart.');
    }

// افراغ السلة
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

//    عرض السلة
    public function showCart()
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('status', 'cart')->first();

        $orderItems = $order ? $order->items()->with('product')->get() : collect();
        $total = $order ? $order->total : 0;

        return view('user.cart.index', compact('orderItems', 'total'));
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

//  لفحص قبل الشراء
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

//  سجل الطلبات
    public function ordersHistory()
    {
        $user = auth()->user();
        $orders = \App\Models\Order::where('user_id', $user->id)
            ->where('status', '!=', 'cart') // نستثني السلة الحالية
            ->orderByDesc('created_at')
            ->get();

        return view('user.cart.orders_history', compact('orders'));
    }

// عرض الطلبيات الالي ضيفتها
    public function showOrder($id)
    {
        $user = auth()->user();
        $order = \App\Models\Order::where('user_id', $user->id)
            ->where('id', $id)
            ->where('status', '!=', 'cart')
            ->with('items.product')
            ->firstOrFail();

        return view('user.cart.order_details', compact('order'));
    }

//  نزيل الفاتورة بعد الاكتمال
    public function downloadInvoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        // يمكنك إنشاء Blade جديد للفاتورة مثلاً: resources/views/orders/invoice.blade.php
        $pdf = Pdf::loadView('user.orders.invoice', compact('order'));
        $filename = "invoice_order_{$order->id}.pdf";

        return $pdf->download($filename);
    }

public function stripeCheckout(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));
    // احسب المجموع الكلي من السلة أو من البيانات
    $amount = auth()->user()->cart_total * 100; // Stripe uses cents

    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Order from ' . auth()->user()->name,
                ],
                'unit_amount' => $amount,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('orders.history') . '?success=1',
        'cancel_url' => route('cart.show') . '?canceled=1',
    ]);

    return redirect($session->url);
}



}
