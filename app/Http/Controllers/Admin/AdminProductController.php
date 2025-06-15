<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index() {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }
    public function create() {
        return view('admin.products.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'img' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        Product::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'تمت إضافة المنتج!');
    }
    public function show(Product $product) {
        return view('admin.products.show', compact('product'));
    }
    public function edit(Product $product) {
        return view('admin.products.edit', compact('product'));
    }
    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'img' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
        $product->update($request->all());
        return redirect()->route('admin.products.index')->with('success', 'تم التعديل!');
    }
    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم الحذف!');
    }
}
