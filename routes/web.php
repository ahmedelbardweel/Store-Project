<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReplyController;
use Illuminate\Http\Request;
use App\Models\Product;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================== الصفحة الرئيسية ======================
Route::get('/', function (Request $request) {
    if ($request->cookie('visited')) {
        // زار الموقع من قبل، وجهه للمنتجات مباشرة
        return redirect()->route('products.index');
    }
    // جلب المنتجات الأكثر مبيعًا أو الجديدة (يمكنك تغيير الكويري حسب رغبتك)
    $products = Product::latest()->take(6)->get();

    // أول زيارة، اعرض له الصفحة الترحيبية مع المنتجات
    return response()
        ->view('home', compact('products'))
        ->cookie('visited', true, 1); // يبقى 1 يوم
})->name('home');


// =============== المنتجات العامة (لكل الزوار) ===================
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/autocomplete', [ProductController::class, 'autocomplete'])->name('products.autocomplete');

// ================== تفاصيل المنتج (Slug) =====================
Route::get('/products/{slug}/{title?}', [ProductController::class, 'show'])
    ->name('products.show')
    ->where([
        'slug'  => '[A-Za-z0-9\-]+',
        'title' => '[A-Za-z0-9\-]+',
    ]);

// =============== تقييم المنتجات (reviews) ===============
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store')
    ->middleware('auth');

// رد المستخدم على رد الأدمن (متاح للمستخدمين المسجلين فقط)
Route::post('/reviews/{review}/user-reply', [ReviewController::class, 'userReply'])
    ->name('reviews.userReply')
    ->middleware('auth');

// ============= إدارة المنتجات (CRUD) للمستخدمين المخولين =============
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// ====================== السلة & الطلبات =================
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/cart/remove/{id}',   [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/empty',         [CartController::class, 'empty'])->name('cart.empty');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // عرض الطلبات
    Route::get('/orders', [CartController::class, 'ordersHistory'])->name('orders.history');
    Route::get('/orders/{id}', [CartController::class, 'showOrder'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [CartController::class, 'downloadInvoice'])->name('orders.invoice');
});

// ====================== الملف الشخصي =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',      [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',     [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =================== لوحة تحكم الأدمن ========================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', \App\Http\Controllers\Admin\AdminProductController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::resource('reports', \App\Http\Controllers\Admin\AdminReportController::class);
    Route::get('/reports/sales', [\App\Http\Controllers\Admin\AdminReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reviews', [\App\Http\Controllers\Admin\AdminReviewController::class, 'index'])->name('reviews.index');
    // حفظ رد الأدمن على التعليق
    Route::post('/reviews/{review}/reply', [ReplyController::class, 'store'])->name('replies.store');
});

// ============== اختبار الإيميل (اختياري) ===================
Route::get('/test-mail', function () {
    Mail::to('recipient@example.com')->send(new WelcomeMail());
    return "Mail sent!";
});

// ============== نظام المصادقة الافتراضي ===================
require __DIR__.'/auth.php';
