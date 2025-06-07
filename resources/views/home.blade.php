@extends('layouts.app')

@section('content')
    <div class="flex flex-col lg:flex-row items-center gap-12 py-16 px-8 bg-gradient-to-br from-blue-100 to-emerald-50 dark:from-gray-800 dark:to-gray-900 rounded-3xl shadow-xl">
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
                We are in<span class="font-bold text-emerald-600">Store</span>We believe that precise marketing should be an easy and enjoyable experience for all customers.
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
            <a href="{{ route('products.index') }}"
               class="inline-block px-8 py-3 rounded-xl bg-blue-500 hover:bg-emerald-500 text-white text-lg font-bold shadow transition">
                Browse products
            </a>
        </div>
    </div>
@endsection
