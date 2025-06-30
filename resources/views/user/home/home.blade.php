@extends('layouts.app')

@section('content')
    {{-- HERO SECTION --}}
    <section class="min-h-screen flex flex-col md:flex-row items-center justify-center px-6 md:px-20 bg-white" id="hero">
        <div class="flex-1 flex flex-col justify-center gap-8">
            <h1 class="text-4xl md:text-6xl font-extrabold uppercase leading-tight">
                Nike <span class="text-green-400">Air Max</span><br>Collection 2025
            </h1>
            <p class="text-base md:text-lg text-black max-w-md">
                Discover the latest in performance and street style. Run faster, feel lighter. Engineered for comfort, designed for impact.
            </p>
            <a href="#products"
               class="inline-block bg-green-400 text-black px-8 py-4 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400"
               style="border-radius:0; width:fit-content;">
                Shop Now
            </a>
        </div>
        <div class="flex-1 flex justify-center items-center mt-12 md:mt-0">
            <img src="https://i.pinimg.com/736x/f7/e4/0c/f7e40ce0feb05bb5e3d83f1c9a60aafe.jpg"
                 alt="Nike Air Max"
                 class="w-[320px] md:w-[420px] drop-shadow-2xl animate-pulse"
                 style="border-radius:0;">
        </div>
    </section>

    {{-- FEATURED PRODUCTS SECTION --}}
    <section class="min-h-screen flex flex-col justify-center bg-gray-50 px-6 md:px-20" id="products">
        <h2 class="text-3xl md:text-4xl font-black text-black mb-12 mt-8 md:mt-0 text-center">Featured Nike Shoes</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 w-full">
            @forelse($products as $product)
                <div class="flex flex-col items-center text-center bg-white shadow-lg border border-gray-200 p-7 hover:shadow-2xl transition-all" style="border-radius:0; min-height:430px;">
                    <img src="{{ $product->img ?? 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5823.png' }}"
                         alt="{{ $product->name }}"
                         class="h-100 w-full border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105 duration-300"
                         style="border-radius:0;">
                    <div class="font-black text-lg text-gray-900 mb-2">{{ $product->name }}</div>
                    <div class="text-gray-500 mb-2 text-sm">{{ $product->description }}</div>
                    <div class="font-extrabold text-green-500 text-xl mb-4">${{ number_format($product->price, 2) }}</div>
                    <a href="{{ route('products.show', [$product->slug, \Illuminate\Support\Str::slug($product->name)]) }}"
                       class="w-full bg-black text-white py-2 font-bold tracking-widest uppercase hover:bg-green-400 hover:text-black transition"
                       style="border-radius:0;">
                        Buy Now
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-400">No products available at the moment.</div>
            @endforelse
        </div>
    </section>

    {{-- باقي السكاشن كما كانت بدون تغيير ... --}}
    {{-- SHOWCASE --}}
    <section class="min-h-screen flex items-center justify-center px-6 md:px-20 bg-gray-100" id="showcase">
        <div class="w-full flex flex-col md:flex-row items-center justify-between gap-16">
            <img src="https://pngimg.com/uploads/running_shoes/running_shoes_PNG5826.png"
                 alt="Nike Showcase"
                 class="w-80 md:w-96 drop-shadow-xl hidden md:block" style="border-radius:0;">
            <div class="flex-1 flex flex-col gap-6">
                <h2 class="text-4xl md:text-5xl font-extrabold text-black uppercase">Elevate your <span class="text-green-400">Run</span></h2>
                <p class="text-black text-base md:text-lg max-w-xl">
                    Every Nike shoe is crafted for performance. Lightweight, durable, and iconic. Feel the difference with every step, on every surface.
                </p>
                <a href="#products" class="inline-block bg-green-400 text-black px-8 py-3 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400" style="border-radius:0;">
                    Explore Collection
                </a>
            </div>
        </div>
    </section>

    {{-- TESTIMONIALS --}}
    <section class="min-h-screen flex flex-col justify-center bg-green-50 px-6 md:px-20" id="testimonials">
        <h2 class="text-3xl md:text-4xl font-black text-black mb-14 text-center">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'name'=>'Sarah Williams',
                    'review'=>'I wear Nike every day. Best comfort and the design is unbeatable!',
                    'img'=>''
                ],
                [
                    'name'=>'Mike Jordan',
                    'review'=>'My Nike Air Max took my running to a new level. Totally recommended.',
                    'img'=>''
                ],
                [
                    'name'=>'Lina Morgan',
                    'review'=>'Super light and stylish. Worth every dollar!',
                    'img'=>''
                ]
            ] as $t)
                <div class="bg-white border border-gray-200 shadow-lg p-8 flex flex-col items-center" style="border-radius:0;">
                    <img src="{{ $t['img'] }}" class="h-100 p-10 w-full border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105 duration-300" style="border-radius:0;">
                    <div class="text-lg font-bold text-gray-800 mb-1">{{ $t['name'] }}</div>
                    <div class="text-sm text-gray-500 text-center">{{ $t['review'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="min-h-screen flex flex-col justify-center items-center text-black px-6 md:px-20" id="contact" style="background-color: #d0f6d2">
        <div class="w-full max-w-lg mx-auto bg-white p-8 shadow-lg border border-gray-200" style="border-radius:0;">
            <h2 class="text-3xl font-black mb-8">Contact Nike Store</h2>
            <form class="flex flex-col gap-4">
                <input type="text" placeholder="Name" class="bg-white text-black border border-gray-400 px-4 py-3 focus:ring-2 focus:ring-green-400" style="border-radius:0; font-size:14px;">
                <input type="email" placeholder="Email" class="bg-white text-black border border-gray-400 px-4 py-3 focus:ring-2 focus:ring-green-400" style="border-radius:0; font-size:14px;">
                <textarea rows="3" placeholder="Your message" class="bg-white text-black border border-gray-400 px-4 py-3 focus:ring-2 focus:ring-green-400" style="border-radius:0; font-size:14px;"></textarea>
                <button type="submit" class="bg-green-400 text-black px-6 py-3 font-bold uppercase tracking-widest hover:bg-white hover:text-green-500 transition border-2 border-green-400" style="border-radius:0;">
                    Send Message
                </button>
            </form>
        </div>
    </section>

    <footer class="bg-white py-8 text-center text-black text-xs border-t border-gray-100">
        &copy; {{ date('Y') }} Nike Store. All Rights Reserved.
    </footer>
@endsection
