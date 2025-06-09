<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // جلب آخر 6 منتجات من قاعدة البيانات (يمكنك تغيير العدد حسب حاجتك)
        $products = Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('home', compact('products'));
    }
}
