<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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

    public function increase($id)
    {
        $key = 'cart_' . auth()->id();
        $cart = session()->get($key, []);
        if(isset($cart[$id])) $cart[$id]++;
        session()->put($key, $cart);
        return back();
    }

    public function decrease($id)
    {
        $key = 'cart_' . auth()->id();
        $cart = session()->get($key, []);
        if(isset($cart[$id]) && $cart[$id] > 1) {
            $cart[$id]--;
            session()->put($key, $cart); // <--- تم تصحيحها هنا
        }
        return back();
    }

    public function remove($id)
    {
        $key = 'cart_' . auth()->id();
        $cart = session()->get($key, []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put($key, $cart);
        }
        return back();
    }

    public function empty()
    {
        $key = 'cart_' . auth()->id();
        session()->forget($key); // <--- تم تصحيحها هنا
        return redirect()->route('cart.index')->with('success', 'The basket has been emptied successfully!');
    }
}
