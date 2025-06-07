<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // السماح للجميع برؤية قائمة وتفاصيل المنتجات
        $this->middleware('auth')->except(['index', 'show', 'autocomplete']);
    }

    // قائمة المنتجات (بحث متطور)
    public function index(Request $request)
    {
        // 1. جميع الـ Slugs المميزة الموجودة في قاعدة البيانات
        $slugs = \App\Models\Product::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->distinct()
            ->pluck('slug');

        // 2. البحث حسب slug (لو موجود في الرابط)
        $selectedSlug = $request->get('slug');

        $productsQuery = \App\Models\Product::query();

        if ($selectedSlug) {
            $productsQuery->where('slug', $selectedSlug);
        }

        if ($request->has('search') && trim($request->search) !== '') {
            $search = trim($request->search);
            $words = array_filter(explode(' ', $search));

            $productsQuery->where(function($query) use ($words) {
                foreach ($words as $word) {
                    $query->orWhere('name', 'LIKE', "%{$word}%")
                        ->orWhere('description', 'LIKE', "%{$word}%");
                }
            });
        }

        $products = $productsQuery->latest()->get();

        // لا تنس تمرير $slugs و $selectedSlug للواجهة
        return view('products.index', compact('products', 'slugs', 'selectedSlug'));
    }

// بحث الاقتراحات (autocomplete)
    public function autocomplete(Request $request)
    {
        $results = [];

        if ($request->has('q')) {
            $term = trim($request->q);
            $words = array_filter(explode(' ', $term));

            $query = Product::query();

            $query->where(function($q) use ($words) {
                foreach ($words as $word) {
                    $q->orWhere('name', 'LIKE', "%{$word}%")
                        ->orWhere('description', 'LIKE', "%{$word}%");
                }
            });

            $results = $query->limit(8)->pluck('name');
        }

        return response()->json($results);
    }

    // نموذج إضافة منتج (فقط للأدمن)
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'not allowed!');
        }
        return view('products.create');
    }

    // حفظ منتج جديد (فقط للأدمن)
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'not allowed!');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'nullable|string|max:255',
            'price'       => 'required|numeric',
            'img'         => 'nullable|url',
        ]);

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'slug'        => $request->slug,
            'price'       => $request->price,
            'img'         => $request->img,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product added successfully!');
    }

    // عرض تفاصيل منتج

    // نموذج تعديل منتج (أدمن فقط)
    public function edit(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'not allowed!');
        }
        return view('products.edit', compact('product'));
    }

    // تحديث المنتج (أدمن فقط)
    public function update(Request $request, Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'not allowed!');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug'        => 'nullable|string|max:255',
            'price'       => 'required|numeric',
            'img'         => 'nullable|url',
        ]);

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'slug'        => $request->slug,
            'price'       => $request->price,
            'img'         => $request->img,
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    // حذف المنتج (أدمن فقط)
    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'not allowed!');
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'The product has been successfully removed!');
    }

    public function show($slug, $title = null)
    {
        // 1) حاول جلب المنتج كـ slug
        $product = Product::where('slug', $slug)->first();

        // 2) إذا ما وجدناه وبالمقابل slug هو رقم، جرب find بالـ id
        if (! $product && is_numeric($slug)) {
            $product = Product::find($slug);
        }

        // 3) إذا ما وجدناه بأي طريقة، أرسل 404
        if (! $product) {
            abort(404);
        }

        // 4) جلب 4 منتجات متشابهة (عشوائيًا)
        $relatedProducts = Product::where('id', '<>', $product->id)
            ->inRandomOrder()
            ->take(20)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

}
