<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'home'])->name('home');

// ------------------ منتجات (عامة) ------------------

// قائمة المنتجات (Index) - متاحة للجميع
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

// اقتراحات البحث (Autocomplete) - متاحة للجميع
Route::get('/products/autocomplete', [ProductController::class, 'autocomplete'])
    ->name('products.autocomplete');

// ------------------ إدارة المنتجات (محمي بالأدمن) ------------------
Route::middleware(['auth', 'verified'])->group(function () {
    // نموذج إضافة منتج
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    // حفظ منتج جديد
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    // نموذج تعديل منتج
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    // تحديث منتج
    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    // حذف منتج
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');
});

// ------------------ عرض تفاصيل المنتج (Slug) ------------------
// يُعرّف بعد مسارات الإدارة حتى لا يتضارب مع "create" أو "autocomplete"
Route::get('/products/{slug}/{title?}', [ProductController::class, 'show'])
    ->name('products.show')
    ->where([
        'slug'  => '[A-Za-z0-9\-]+',
        'title' => '[A-Za-z0-9\-]+',
    ]);

// ------------------ السلة ------------------
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}',   [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/empty',         [CartController::class, 'empty'])->name('cart.empty');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // الطلبات
    Route::get('/orders', [CartController::class, 'ordersHistory'])->name('orders.history');
    Route::get('/orders/{id}', [CartController::class, 'showOrder'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [CartController::class, 'downloadInvoice'])->name('orders.invoice');
});

// ------------------ الملف الشخصي ------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',      [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',     [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------ اختبار الإيميل ------------------
Route::get('/test-mail', function () {
    Mail::to('recipient@example.com')->send(new WelcomeMail());
    return "Mail sent!";
});

// ------------------ مصادقة النظام ------------------
require __DIR__.'/auth.php';
