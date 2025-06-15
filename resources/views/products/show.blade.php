<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-white from-blue-50 via-white to-emerald-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
<!-- الهيدر -->

<nav
    class="fixed top-0 left-0 w-full pt-1 pb-1 z-40 bg-white dark:bg-gray-900/95 shadow-sm backdrop-blur border-b border-gray-100 dark:border-gray-800">
    <div class="flex items-center justify-between h-12 px-8">
        <!-- Logo & Brand -->
        <div class="flex items-center gap-4 flex-shrink-0">
            <a href="{{ route('products.index') }}"
               class="flex items-center gap-2 text-emerald-700 dark:text-emerald-300 font-bold text-base hover:text-emerald-500 transition group">
                <svg class="w-6 h-6 group-hover:-translate-x-1 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>

            </a>
            <span
                class="text-xl font-extrabold text-emerald-600 dark:text-emerald-300 tracking-tight select-none mr-20">
                AHMED
            </span>
        </div>

        <!-- Center: Search bar (Desktop) -->
        <div
            class="relative hidden md:block w-[320px] border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-base">
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center w-full">
                <input
                    id="product-search"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Searching..."
                    autocomplete="off"
                    class="flex h-10 px-5"
                >
                <button type="submit"
                        class="h-10 px-4 flex items-center justify-center bg-blue-400 hover:bg-blue-300 text-white font-semibold">
                    <span class="material-symbols-outlined" style="color: #ffffff;" >search</span>
                </button>
            </form>
            <ul id="suggestions"
                class="absolute z-50 left-0 right-0 mt-1 bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-700 hidden max-h-72 overflow-auto"></ul>
        </div>

        <!-- Right: Icons nav + user -->
        <div class="flex items-center gap-2">
            @auth
                <ul class="flex">
                    <!-- الرئيسية -->
                    <li>
                        <a href="{{ route('home') }}"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="الرئيسية">
                            <span class="material-symbols-outlined text-[22px] align-middle">home</span>
                        </a>
                    </li>
                    <!-- المنتجات -->
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="المنتجات">
                            <span class="material-symbols-outlined">shopping_bag</span>
                        </a>
                    </li>
                    <!-- السلة -->
                    <li>
                        <a href="{{ route('cart.show') }}"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="السلة">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </a>
                    </li>
                    <!-- إضافة منتج جديد (أدمن فقط) -->
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('products.create') }}"
                               class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                               title="إضافة منتج جديد">
                                <span class="material-symbols-outlined">add_circle</span>
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 w-11 h-11">
                        <img
                            src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=38bdf8&color=fff&rounded=true' }}"
                            alt="User Avatar"
                            class="h-9 w-9 rounded-full object-cover"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 dark:text-gray-300"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-cloak
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-900 rounded-xl shadow-lg z-50 py-4 px-4 text-center transition border border-gray-100 dark:border-gray-700"
                        x-transition
                    >
                        <div class="mb-3">
                            <span
                                class="block font-bold text-lg text-emerald-700 dark:text-emerald-300">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-xs text-gray-500 dark:text-gray-400 mb-2">{{ Auth::user()->email }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                           class="block w-full py-2 my-2 rounded-lg bg-blue-50 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-700 text-blue-700 dark:text-blue-300 font-semibold transition">
                            الملف الشخصي
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full py-2 mt-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition">
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-xl bg-blue-500 hover:bg-blue-700 text-white font-semibold shadow transition">
                    تسجيل الدخول
                </a>
            @endauth
        </div>
    </div>

    <!-- بحث للموبايل فقط -->
    <div class="relative md:hidden w-full px-4 pb-3 pt-2 bg-white dark:bg-gray-900">
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2 w-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
            <input
                id="product-search-mobile"
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="ابحث عن منتج أو نوع المنتج..."
                autocomplete="off"
                class="flex-1 h-11 px-4 rounded-xl  text-base w-full"
            >
            <button type="submit"
                    class="h-11 px-4 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <circle cx="11" cy="11" r="7" stroke-width="2"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"/>
                </svg>
            </button>
        </form>
        <ul id="suggestions-mobile"
            class="absolute z-50 left-0 right-0 mt-1 bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-700 hidden max-h-72 overflow-auto"></ul>
    </div>
</nav>



<!-- تفاصيل المنتج -->
<div class="max-w-4xl mx-auto p-6 flex flex-col md:flex-row gap-10 mt-20 bg-white/90 dark:bg-gray-900/90  rounded-3xl border border-emerald-100 dark:border-gray-800">
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
    <div class=" flex flex-col">
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
        <div class="flex flex-col gap-2 mt-20">
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

{{-- قسم المنتجات المتشابهة --}}
<div class="mt-16 max-w-6xl mx-auto px-6">
    <h2 class="text-2xl font-bold text-emerald-700 dark:text-emerald-300 mb-6">
        Similar products
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($relatedProducts as $related)
            <a href="{{ route('products.show', [
                    'slug'  => $related->slug,
                    'title' => \Illuminate\Support\Str::slug($related->name)
                ]) }}"
               class="group block bg-white/80 dark:bg-gray-900/80 rounded-2xl overflow-hidden shadow hover:shadow-lg transition p-4">
                <div class="w-full h-40 mb-4 bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden">
                    <img src="{{ $related->img ?? 'https://via.placeholder.com/300x200' }}"
                         alt="{{ $related->name }}"
                         class="object-cover w-full h-full">
                </div>
                <h3 class="text-lg font-semibold text-emerald-700 dark:text-emerald-200 mb-1">
                    {{ Str::limit($related->name, 30) }}
                </h3>
                <div class="flex items-center justify-between">
                    <span class="text-green-600 dark:text-green-400 font-bold">
                        {{ $related->price }} $
                    </span>
                    <span class="text-gray-500 text-sm">(to watch)</span>
                </div>
            </a>
        @empty
            <p class="text-gray-600 dark:text-gray-400">
                There are currently no similar products.
            </p>
        @endforelse
    </div>
</div>


</body>
</html>
