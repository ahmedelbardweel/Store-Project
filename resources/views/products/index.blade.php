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


    {{-- تصنيفات Slugs --}}
    @if($slugs->count())
        <div class="w-full overflow-x-auto hide-scrollbar mb-10">
            <div class="flex gap-2 min-w-max py-1">
                <a href="{{ route('products.index') }}"
                   class="px-5 py-1 flex-shrink-0 rounded-full text-sm font-bold transition
                   {{ !$selectedSlug ? ' text-black bg-blue-200 dark:bg-gray-800' : 'bg-gray-300 dark:bg-gray-800 text-gray-800 dark:text-gray-300 hover:bg-emerald-100 dark:hover:bg-emerald-800' }}">
                    All
                </a>
                @foreach($slugs as $slug)
                    <a href="{{ route('products.index', ['slug' => $slug]) }}"
                       class="px-5 py-1 flex-shrink-0 rounded-full text-sm font-bold transition
                       {{ $selectedSlug == $slug ? 'text-black bg-blue-200  dark:bg-gray-800' : 'bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-emerald-500 dark:hover:bg-emerald-800' }}">
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
