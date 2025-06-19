<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // جلب المنتجات من قاعدة البيانات (مثلاً أفضل 6 منتجات)
        $products = Product::latest()->take(6)->get();

        // إرسالها إلى الـ view
        return view('home', compact('products'));
    }
}

