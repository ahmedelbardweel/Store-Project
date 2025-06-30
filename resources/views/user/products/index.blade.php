@extends('layouts.app')

@section('content')
    <style>
        .sharp-banner {
            border-radius: 0;
            overflow: hidden;
            margin-bottom: 28px;
            height: 48px;
            display: flex;
            color: black;
            align-items: center;
            position: relative;
        }
        .sharp-banner .sharp-banner-content {
            display: inline-block;
            white-space: nowrap;
            font-size: 1.1rem;
            font-weight: bold;
            color: #000000;
            animation: sharp-banner-move 14s linear infinite;
            letter-spacing: .5px;
            text-shadow: 0 1px 10px #007cf055;
        }
        @keyframes sharp-banner-move {
            0% { transform: translateX(100%);}
            100% { transform: translateX(-100%);}
        }
        .dark .sharp-section-title {
            border-bottom: 3px solid #529155;
        }
        .sharp-card {
            border-radius: 0;
            box-shadow: 0 2px 12px #00dfd825;
            border: 1.5px solid #e5e7eb;
            transition: box-shadow .18s, border-color .18s;
            background: #fff;
            overflow: hidden;
        }
        .sharp-card:hover {
            box-shadow: 0 8px 24px #00dfd849;
            border-color: #00dfd8;
            z-index: 2;
        }
        .dark .sharp-card {
            border-color: #222;
            border-radius: 1px;
        }
        .dark .sharp-card:hover {
            border-color: #007cf0;
        }

        /* إطار صورة المنتج في نتائج البحث */
        .search-exact-img-box {
            width: 100%;
            min-height: 180px;
            max-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border-bottom: 1px solid #eee;
        }
        .search-exact-img-box img {
            max-width: 170px;
            max-height: 150px;
            object-fit: contain;
            margin: auto;
            display: block;
        }
    </style>

    <div class="mx-auto mt-20">

        {{-- منطق البحث --}}
        @if(request('search'))
            <div class="mb-10">
                <h2 class="sharp-section-title">نتائج البحث عن "{{ request('search') }}"</h2>

                {{-- المنتج المطابق بالضبط --}}
                @if($exactProduct)
                    <div class="sharp-card mb-5 max-w-lg mx-auto">
                        <div class="search-exact-img-box">
                            <img src="{{ $exactProduct->img }}" alt="{{ $exactProduct->name }}">
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-xl mb-1">{{ $exactProduct->name }}</h3>
                            <div class="text-gray-600 mb-2">{{ $exactProduct->description }}</div>
                            <div class="font-bold text-lg mb-3">{{ $exactProduct->price }}$</div>
                            <form method="POST" action="{{ route('cart.add', $exactProduct->id) }}">
                                @csrf
                                <button class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- المنتجات المشابهة --}}
                @if($similarProducts && $similarProducts->count())
                    <h3 class="text-lg font-bold mb-2 mt-8">منتجات مشابهة:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7 mb-7">
                        @foreach($similarProducts as $product)
                            <div class="sharp-card">
                                @include('user.products._card', ['product' => $product])
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- لا يوجد نتائج --}}
                @if(!$exactProduct && (!$similarProducts || $similarProducts->isEmpty()))
                    <div class="py-24 text-center text-gray-400 text-lg">
                        لا يوجد منتجات مطابقة لبحثك.
                    </div>
                @endif
            </div>
        @else
            {{-- عرض جميع الأقسام --}}
            @foreach($sections as $sectionName => $products)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7 mb-7">
                    @forelse($products as $product)
                        <div class="sharp-card">
                            @include('user.products._card', ['product' => $product])
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500 dark:text-gray-400 text-lg py-6">
                            {{ __('messages.no_products') }}
                        </p>
                    @endforelse
                </div>
                <div class="sharp-banner">
                    <span class="sharp-banner-content">
                        {{ __('messages.banner_offer', ['section' => __($sectionName)]) }}
                    </span>
                </div>
            @endforeach
        @endif

    </div>
@endsection
