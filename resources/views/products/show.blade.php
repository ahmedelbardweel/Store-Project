<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-emerald-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
<!-- الهيدر -->
<nav class="bg-white/80 dark:bg-gray-900/90 shadow-lg px-6 md:px-20 h-16 flex items-center sticky top-0 z-50 border-b border-emerald-100 dark:border-gray-800 backdrop-blur">
    <a href="{{ route('products.index') }}"
       class="flex items-center gap-2 text-emerald-700 dark:text-emerald-300 font-bold text-base hover:text-emerald-500 transition group">
        <svg class="w-6 h-6 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
        Products
    </a>
</nav>

<!-- تفاصيل المنتج -->
<div class="max-w-6xl mx-auto p-6 flex flex-col md:flex-row gap-10 mt-10 bg-white/90 dark:bg-gray-900/90  rounded-3xl border border-emerald-100 dark:border-gray-800">
    <!-- صور المنتج -->
    <div class="md:w-1/2 flex flex-col items-center" x-data="{ activeImg: 0, images: [
        @if($product->gallery)
            @foreach(json_decode($product->gallery) as $img)
                '{{ $img }}',
            @endforeach
        @else
            '{{ $product->img }}',
        @endif
    ]}">
        <div class="w-full max-w-xs aspect-w-1 aspect-h-1 rounded-2xl overflow-hidden shadow-lg border border-emerald-100 dark:border-gray-800 mb-5 bg-gradient-to-br from-emerald-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center">
            <img
                :src="images.length ? images[activeImg] : 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?auto=format&fit=crop&w=600&q=80'"
                alt="فستان بناتي (أديداس) أطفال"
                class="object-cover w-full h-72 rounded-xl shadow transition duration-500"
                loading="lazy"
            />

        </div>
        <!-- صور مصغرة -->
        <div class="flex gap-2 mt-2">
            <template x-for="(img, i) in images" :key="i">
                <button @click="activeImg = i"
                        :class="{'ring-2 ring-emerald-400': activeImg === i }"
                        class="w-14 h-14 rounded-xl overflow-hidden border border-emerald-100 dark:border-gray-700 transition hover:ring-2 hover:ring-emerald-400">
                    <img :src="img" alt="thumbnail" class="object-cover w-full h-full">
                </button>
            </template>
        </div>
    </div>

    <!-- بيانات المنتج -->
    <div class="md:w-1/2 flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-emerald-700 dark:text-emerald-200 mb-2">{{ $product->name }}</h1>
            <!-- تقييم (نجوم افتراضية أو ديناميكية) -->
            <div class="flex items-center gap-2 mb-3">
                <span class="flex">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                </span>
                <span class="text-gray-500 text-sm">(125 reviews)</span>
            </div>
            <div class="flex flex-wrap gap-3 items-center mb-3">
                <span class="text-2xl font-extrabold text-green-600 dark:text-green-400 px-4 py-2 bg-green-50 dark:bg-green-900/30 rounded-xl shadow">{{ $product->price }} $</span>
                <span class="text-base text-gray-600 dark:text-gray-300">Tax included</span>
            </div>
            <div class="mb-5 text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
                {{ $product->description }}
            </div>
            <!-- خيارات ألوان المنتج أو أحجام إذا كانت موجودة -->
            @if($product->colors)
                <div class="mb-5">
                    <span class="font-bold">colors:</span>
                    <div class="flex gap-2 mt-2">
                        @foreach(json_decode($product->colors) as $color)
                            <span class="w-7 h-7 rounded-full border-2 border-gray-300" style="background:{{ $color }}"></span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <!-- زر إضافة للسلة -->
        <div class="flex flex-col gap-2 mt-2">
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full px-5 py-2 bg-gradient-to-r from-blue-400 via-emerald-500 to-blue-600 hover:from-emerald-500 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg transition text-base">
                    Add to cart 🛒
                </button>
            </form>
        </div>
{{--        <!-- مواصفات تقنية (اختياري) -->--}}
{{--        <div class="mt-10 hidden md:block">--}}
{{--            <h3 class="text-lg font-bold text-emerald-700 dark:text-emerald-300 mb-2">المواصفات:</h3>--}}
{{--            <ul class="text-gray-700 dark:text-gray-300 text-base space-y-2">--}}
{{--                <li><span class="font-semibold">المعالج:</span> Snapdragon 680</li>--}}
{{--                <li><span class="font-semibold">الذاكرة:</span> 4 GB</li>--}}
{{--                <li><span class="font-semibold">التخزين:</span> 64 GB</li>--}}
{{--                <li><span class="font-semibold">الكاميرا:</span> 50 MP</li>--}}
{{--                <li><span class="font-semibold">النظام:</span> Android 13</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</div>

</body>
</html>
