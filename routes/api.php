<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    return response()->json([
        'user' => $user,
        'api_key' => $user->api_key,
    ]);
});
Route::middleware('api.key')->get('/users', function () {
    return response()->json([
        'users' => \App\Models\User::with('orders.orderItems.product')->get()
    ]);
});

Route::get('/products', function () {
    return response()->json([
        'products' => Product::all()
    ]);
});

Route::get('/product_details/{id}', function ($id) {
    $product = Product::with('reviews')->findOrFail($id);
    return response()->json([
        'product' => $product
    ]);
});


Route::middleware('api.key')->get('/all-orders', function () {
    return response()->json([
        'orders' => Order::with('orderItems')->get()
    ]);
});

Route::middleware('api.key')->get('/orderItems', function () {
    return response()->json([
        'orders' => Order::with('orderItems.product')->get()
    ]);
});













