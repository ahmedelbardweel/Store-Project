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

// الصفحة الرئيسية
Route::get('/', fn() => view('home'))->name('home');

// ------------------ منتجات (عامة) ------------------
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/autocomplete', [ProductController::class, 'autocomplete'])
    ->name('products.autocomplete');

// ------------------ إدارة المنتجات (محمي) ------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');
});

// ------------------ عرض تفاصيل المنتج (Slug) ------------------
// هذا المسار يُعرّف آخرًا حتى لا يتضارب مع "create" أو "autocomplete"
Route::get('/products/{slug}/{title?}', [ProductController::class, 'show'])
    ->name('products.show')
    ->where([
        'slug'  => '[A-Za-z0-9\-]+',
        'title' => '[A-Za-z0-9\-]+',
    ]);

// ------------------ السلة ------------------
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{id}',      [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}',   [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart',                [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/empty',         [CartController::class, 'empty'])->name('cart.empty');
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
