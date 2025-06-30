<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        // يجب جلب بيانات السلة أو المنتج
        $amount = 100 * 100; // السعر بالسنتات (100 دولار = 10000 سنت)
        $product_name = 'Sample Product'; // اسم المنتج/الطلب

        Stripe::setApiKey(env('STRIPE_KEY'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'unit_amount' => $amount, // مثال 100 دولار
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }
}
