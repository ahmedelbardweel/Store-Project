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
        $slugs = \App\Models\Product::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->distinct()
            ->pluck('slug');
        $selectedSlug = $request->get('slug');

        $productsQuery = \App\Models\Product::query();

        if ($selectedSlug) {
            $productsQuery->where('slug', $selectedSlug);
        }

        // منطق البحث الذكي
        $exactProduct = null;
        $similarProducts = collect();

        if ($request->has('search') && trim($request->search) !== '') {
            $search = trim($request->search);

            $productsFound = \App\Models\Product::where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->get();

            $exactProduct = $productsFound->firstWhere('name', $search);
            $similarProducts = $productsFound->filter(fn($product) => $product->name !== $search);

            // **هنا** ضع تعريف للـ $products (حتى لو فارغ)
            $products = collect();
            $sections = [];
        } else {
            $products = $productsQuery->latest()->get();

            $sections = [];
            foreach ($slugs as $slug) {
                $productsInSection = $products->where('slug', $slug);
                if ($productsInSection->count()) {
                    $sections[$slug] = $productsInSection;
                }
            }
        }

        // **هنا تأكد أن جميع المتغيرات تمر للواجهة**
        return view('user.products.index', compact(
            'products', 'slugs', 'selectedSlug', 'exactProduct', 'similarProducts', 'sections'
        ));
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

// عرض التفاصيللاالمنتج
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

        return view('user.products.show', compact('product', 'relatedProducts'));
    }

    // بحث الاقتراحات (autocomplete)
    public function autocomplete(Request $request)
    {
        $results = [];

        if ($request->filled('q')) {
            $term = trim($request->q);

            // البحث الجزئي عن أي منتج يحتوي على ما تم إدخاله (case-insensitive)
            $products = \App\Models\Product::where('name', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%")
                ->orderByRaw("INSTR(name, ?) asc", [$term]) // الأولوية للأقرب للبداية
                ->limit(10)
                ->get(['name', 'slug', 'id']);

            foreach ($products as $product) {
                $results[] = [
                    'name' => $product->name,
                    'url'  => route('products.show', [$product->slug, \Illuminate\Support\Str::slug($product->name)]),
                ];
            }
        }

        return response()->json($results);
    }

}
