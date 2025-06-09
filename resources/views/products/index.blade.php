@extends('layouts.app')

@section('content')
    <style>
        [x-cloak] { display: none !important; }
        /* شريط التمرير مخفي */
        .hide-scrollbar {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>

    <div class="flex flex-col lg:flex-row items-center gap-12 py-16 px-8 bg-gradient-to-br from-blue-100 to-emerald-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-xl mb-10">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <div class="w-48 h-48 bg-gradient-to-br from-emerald-400 to-blue-400 rounded-full flex items-center justify-center shadow-2xl overflow-hidden">
                <img src="https://static.vecteezy.com/system/resources/previews/024/824/321/non_2x/online-shop-logo-designs-template-phone-shop-logo-symbol-icon-logo-template-icon-vector.jpg"
                     alt="Store Logo"
                     class="object-cover w-full h-full">
            </div>
        </div>

        <!-- Company Info -->
        <div class="flex-1 max-w-xl">
            <h1 class="text-4xl font-extrabold text-emerald-700 dark:text-emerald-300 mb-4 tracking-tight">
                Welcome to <span class="text-blue-600 dark:text-blue-400">Store company</span>
            </h1>
            <p class="text-lg text-gray-700 dark:text-gray-200 mb-6 leading-relaxed">
                We are in <span class="font-bold text-emerald-600">Store</span>. We believe that precise marketing should be an easy and enjoyable experience for all customers.
                Our goal is to provide customers with high-quality products with distinctive designs.
                The company was founded in 2024 and quickly became a leading brand in the e-commerce sector in the Arab world.
            </p>
            <ul class="mb-6 space-y-2">
                <li class="flex items-center gap-2 text-gray-700 dark:text-gray-200">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Fast and safe delivery to all areas
                </li>
                <li class="flex items-center gap-2 text-gray-700 dark:text-gray-200">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Continuous customer support
                </li>
                <li class="flex items-center gap-2 text-gray-700 dark:text-gray-200">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    Original products at competitive prices
                </li>
            </ul>
        </div>
    </div>

    {{-- تصنيفات Slugs --}}
    @if($slugs->count())
        <div class="w-full overflow-x-auto hide-scrollbar mb-10">
            <div class="flex gap-2 min-w-max py-1">
                <a href="{{ route('products.index') }}"
                   class="px-5 py-1 flex-shrink-0 rounded-full text-sm font-bold transition
                   {{ !$selectedSlug ? 'bg-emerald-600 text-black bg-gray-300 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-100 dark:hover:bg-emerald-800' }}">
                    All
                </a>
                @foreach($slugs as $slug)
                    <a href="{{ route('products.index', ['slug' => $slug]) }}"
                       class="px-5 py-1 flex-shrink-0 rounded-full text-sm font-bold transition
                       {{ $selectedSlug == $slug ? 'bg-emerald-600 text-black bg-gray-300 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-500 dark:hover:bg-emerald-800' }}">
                        {{ $slug }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-800 px-6 py-4 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- منطق البحث الذكي --}}
    @if(isset($exactProduct) && $exactProduct)
        <h3 class="text-xl font-bold text-emerald-600 mb-4">Exact match:</h3>
        <div class="grid grid-cols-1 gap-8 mb-8">
            @include('products._card', ['product' => $exactProduct])
        </div>
    @endif

    @if(isset($similarProducts) && $similarProducts->count())
        <h3 class="text-xl font-bold text-blue-700 mb-4">Similar products:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($similarProducts as $product)
                @include('products._card', ['product' => $product])
            @endforeach
        </div>
    @elseif(isset($products) && $products->count())
        <h3 class="text-2xl font-bold text-blue-700 dark:text-emerald-300 mb-10 tracking-tight"></h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
                @include('products._card', ['product' => $product])
            @endforeach
        </div>
    @else
        <p class="col-span-full text-center text-gray-500 dark:text-gray-400 text-xl py-10">
            There are currently no products.
        </p>
    @endif
@endsection
