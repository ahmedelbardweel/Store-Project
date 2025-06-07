<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية (حول الشركة/واجهة البداية)
Route::get('/', function () {
    return view('home'); // ملف resources/views/home.blade.php
})->name('home');

// ------------------ المنتجات ------------------
// مسار البحث الذكي (Autocomplete) للمنتجات (بدون Auth ليعمل للجميع)
Route::get('/products/autocomplete', [ProductController::class, 'autocomplete'])->name('products.autocomplete');

// بقية عمليات المنتجات (تتطلب تسجيل دخول)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class);
});

// ------------------ السلة ------------------
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
});

// ------------------ الملف الشخصي ------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------ اختبار الإيميل ------------------
Route::get('/test-mail', function () {
    Mail::to('recipient@example.com')->send(new WelcomeMail());
    return "Mail sent!";
});

// ------------------ مصادقة النظام ------------------
require __DIR__.'/auth.php';
