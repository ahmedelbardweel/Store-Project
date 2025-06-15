<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // جلب آخر 6 منتجات من قاعدة البيانات (يمكنك تغيير العدد حسب حاجتك)
    public function home()
    {
        $products = Product::orderBy('created_at', 'desc')->take(3)->get();
        return view('Home.home', compact('products'));
    }
}
