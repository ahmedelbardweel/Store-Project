@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- Alpine.js للـ FAQ --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- HERO: Modern Studio/Firebase Style --}}
    <div class="relative min-h-[60vh] flex flex-col justify-center items-center overflow-hidden bg-gradient-to-br from-blue-50 via-emerald-50 to-white dark:from-gray-900 dark:to-gray-800">
        {{-- Animating background shapes --}}
        <div class="absolute left-[-120px] top-[-100px] w-[350px] h-[350px] bg-blue-400/10 rounded-full blur-2xl animate-spin-slow z-0"></div>
        <div class="absolute right-[-90px] bottom-[-80px] w-[220px] h-[220px] bg-emerald-400/10 rounded-full blur-2xl animate-pulse z-0"></div>
        <div class="absolute left-1/3 top-2/3 w-[80px] h-[80px] bg-blue-400/10 rounded-full blur-xl z-0 animate-bounce"></div>

        {{-- Content --}}
        <div class="relative z-10 max-w-4xl w-full mx-auto text-center py-20 px-6">
            <div class="mx-auto flex flex-col md:flex-row items-center md:justify-between gap-12">
                {{-- Left: Headline + CTA --}}
                <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left gap-7">
                    <h1 class="text-4xl md:text-5xl font-black leading-tight text-emerald-700 dark:text-emerald-300 animate__animated animate__fadeInDown">
                        Build, Grow & Shop <br>
                        <span class="text-blue-600 dark:text-blue-400">with Store Company</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 font-semibold mb-2 animate__animated animate__fadeInUp">
                        Modern eCommerce platform for the digital era.
                    </p>
                    <div class="flex flex-wrap gap-3 items-center justify-center md:justify-start mt-2">
                        <a href="{{ route('products.index') }}"
                           class="px-10 py-3 rounded-xl bg-blue-500 hover:bg-emerald-500 text-white text-lg font-bold shadow-lg transition transform hover:scale-105 animate__animated animate__pulse animate__infinite">
                            Start Shopping
                        </a>
                        <a href="#contact"
                           class="px-8 py-3 rounded-xl border border-blue-500 text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-gray-800 text-lg font-semibold shadow transition">
                            Contact Sales
                        </a>
                    </div>
                </div>
                {{-- Right: SVG Illustration --}}
                <div class="flex-1 flex justify-center items-center">
                    <img src="{{ asset('images/undraw_web-shopping_m3o2.svg') }}"
                         alt="Online Shopping"
                         class="w-80 h-64 object-contain drop-shadow-xl animate__animated animate__zoomIn">
                </div>


            </div>
        </div>
    </div>


    {{-- Best Selling Products - Dynamic from DB --}}
    <section class="py-14 px-3 max-w-6xl mx-auto animate__animated animate__fadeInUp" id="bestsellers">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-black dark:text-emerald-300 mb-10">Best Selling Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg hover:scale-105 transition-transform animate__animated animate__zoomIn flex flex-col items-center p-5">
                    <img
                        src="{{ $product->img ?? 'https://images.unsplash.com/photo-1515168833906-c93b6c61bc46?auto=format&fit=crop&w=480&q=80' }}"
                        onerror="this.src='https://images.unsplash.com/photo-1515168833906-c93b6c61bc46?auto=format&fit=crop&w=480&q=80';"
                        alt="{{ $product->name }}"
                        class="w-40 h-32 object-cover rounded-xl shadow mb-3"
                    >
                    <div class="text-xl font-bold text-emerald-700 dark:text-emerald-200 mb-1">{{ $product->name }}</div>
                    <div class="text-lg text-gray-700 dark:text-gray-300 mb-1">
                        {{ Str::limit($product->description, 60) }}
                    </div>
                    <span class="text-lg font-bold text-blue-600 mb-3">${{ number_format($product->price, 2) }}</span>
                    <a href="{{ route('products.show', ['slug' => $product->slug, 'title' => Str::slug($product->name)]) }}"
                       class="px-5 py-2 rounded-lg bg-blue-400 hover:bg-blue-600 text-white font-bold shadow">
                        Shop Now
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-400 dark:text-gray-600">No products available at the moment.</div>
            @endforelse
        </div>
    </section>


    {{-- How It Works --}}
    <section class="py-14 bg-gradient-to-br from-emerald-50 to-blue-50 dark:from-gray-900 dark:to-gray-800" id="howitworks">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-emerald-800 dark:text-emerald-200 mb-10">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="flex flex-col items-center text-center animate__animated animate__fadeInUp">
                <span class="w-16 h-16 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 text-3xl mb-3 shadow">
                    <span class="material-symbols-outlined">search</span>
                </span>
                    <div class="font-bold text-lg mb-1">Browse</div>
                    <div class="text-gray-600 dark:text-gray-300">Find your desired products from a wide collection.</div>
                </div>
                <div class="flex flex-col items-center text-center animate__animated animate__fadeInUp" style="animation-delay: .2s;">
                <span class="w-16 h-16 flex items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-900 text-emerald-600 text-3xl mb-3 shadow">
                    <span class="material-symbols-outlined">shopping_cart</span>
                </span>
                    <div class="font-bold text-lg mb-1">Order</div>
                    <div class="text-gray-600 dark:text-gray-300">Add products to cart and place your order easily.</div>
                </div>
                <div class="flex flex-col items-center text-center animate__animated animate__fadeInUp" style="animation-delay: .4s;">
                <span class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 text-3xl mb-3 shadow">
                    <span class="material-symbols-outlined">local_shipping</span>
                </span>
                    <div class="font-bold text-lg mb-1">Fast Delivery</div>
                    <div class="text-gray-600 dark:text-gray-300">Receive your products at your doorstep quickly & safely.</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="py-14 px-4 max-w-6xl mx-auto" id="testimonials">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-emerald-700 dark:text-emerald-200 mb-10">Customer Reviews</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
              ['name' => 'Sara Ali', 'review' => 'Amazing experience, I got my order the next day!', 'img' => 'https://randomuser.me/api/portraits/women/44.jpg'],
              ['name' => 'Mohamed Khaled', 'review' => 'Great prices and excellent customer service.', 'img' => 'https://randomuser.me/api/portraits/men/47.jpg'],
              ['name' => 'Lina Samir', 'review' => 'The website is super easy to use, I will shop again.', 'img' => 'https://randomuser.me/api/portraits/women/65.jpg']
            ] as $t)
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-7 flex flex-col items-center animate__animated animate__zoomIn">
                    <img src="{{ $t['img'] }}" class="w-20 h-20 rounded-full border-4 border-emerald-200 dark:border-emerald-500 shadow mb-3" alt="{{ $t['name'] }}">
                    <div class="text-lg text-gray-800 dark:text-gray-200 mb-2 font-bold">{{ $t['name'] }}</div>
                    <div class="text-gray-600 dark:text-gray-400 text-center">{{ $t['review'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Our Team --}}
    <section class="py-14 bg-gradient-to-br from-blue-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800" id="team">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-blue-700 dark:text-emerald-200 mb-10">Meet Our Team</h2>
            <div class="flex flex-wrap justify-center gap-8">
                @foreach([
                  ['name' => 'Ahmed Taha', 'role' => 'CEO', 'img' => 'https://randomuser.me/api/portraits/men/31.jpg'],
                  ['name' => 'Mona Fathy', 'role' => 'Marketing', 'img' => 'https://randomuser.me/api/portraits/women/68.jpg'],
                  ['name' => 'Rami Hassan', 'role' => 'Developer', 'img' => 'https://randomuser.me/api/portraits/men/54.jpg']
                ] as $member)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-6 w-56 flex flex-col items-center animate__animated animate__fadeInUp">
                        <img src="{{ $member['img'] }}" class="w-20 h-20 rounded-full border-4 border-blue-200 dark:border-emerald-500 shadow mb-3" alt="{{ $member['name'] }}">
                        <div class="font-bold text-lg text-gray-800 dark:text-gray-100 mb-1">{{ $member['name'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ $member['role'] }}</div>
                        <div class="flex gap-2 mt-2">
                            <a href="#" class="text-blue-500 hover:text-blue-700"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.6v14.8A2.6 2.6 0 0 1 21.4 22H2.6A2.6 2.6 0 0 1 0 19.4V4.6A2.6 2.6 0 0 1 2.6 2h18.8A2.6 2.6 0 0 1 24 4.6z"/></svg></a>
                            <a href="#" class="text-blue-400 hover:text-blue-700"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3A10.9 10.9 0 0 1 12 21.6A10.9 10.9 0 0 1 1 3"></path></svg></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact & Map Section --}}
    <section class="py-16 bg-gradient-to-br from-blue-50 to-emerald-50 dark:from-gray-900 dark:to-gray-800" id="contact">
        <div class="max-w-5xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-emerald-700 dark:text-emerald-200 mb-6">Contact Us</h2>
                <div class="text-lg text-gray-700 dark:text-gray-200 mb-4">
                    Email: <a href="mailto:info@store.com" class="text-blue-500 hover:underline">brdweelahmed@gmail.com</a><br>
                    Phone: <a href="tel:+1234567890" class="text-blue-500 hover:underline">+970 595 570 481</a><br>
                    Location: Main Street, City, Country
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-xl ring-2 ring-blue-100 dark:ring-emerald-800">
                <!-- Google Maps Embed -->
                <iframe
                    src="https://www.openstreetmap.org/export/embed.html?bbox=35.214%2C31.760%2C35.218%2C31.763&amp;layer=mapnik"
                    style="border:0; width:100%; height:320px;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-14 px-4 max-w-3xl mx-auto" id="faq">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-emerald-700 dark:text-emerald-200 mb-10">Frequently Asked Questions</h2>
        <div x-data="{selected:null}" class="space-y-3">
            @foreach([
              ['q'=>'How long does delivery take?', 'a'=>'Usually 2-5 business days.'],
              ['q'=>'What payment methods are accepted?', 'a'=>'We accept Visa, MasterCard, PayPal, and Cash on Delivery.'],
              ['q'=>'Can I return a product?', 'a'=>'Yes, within 14 days if the product is in original condition.'],
            ] as $i => $faq)
                <div class="border border-emerald-100 dark:border-emerald-700 rounded-xl bg-white dark:bg-gray-900 shadow">
                    <button class="w-full flex justify-between items-center px-5 py-3 text-lg font-semibold focus:outline-none"
                            @click="selected === {{ $i }} ? selected = null : selected = {{ $i }}">
                        <span>{{ $faq['q'] }}</span>
                        <span x-show="selected === {{ $i }}" class="text-emerald-500">-</span>
                        <span x-show="selected !== {{ $i }}" class="text-emerald-500">+</span>
                    </button>
                    <div x-show="selected === {{ $i }}" class="px-5 pb-4 text-gray-700 dark:text-gray-200">{{ $faq['a'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="mt-20 bg-gradient-to-br from-emerald-100 to-blue-100 dark:from-gray-900 dark:to-gray-800 py-10 px-4">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex flex-col items-center md:items-start">
                <span class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-300">Store Company</span>
                <span class="text-gray-600 dark:text-gray-300 text-sm mt-2">© {{ date('Y') }} All rights reserved.</span>
            </div>
            <div class="flex gap-5">
                <a href="#" class="text-blue-500 hover:text-blue-700"><span class="material-symbols-outlined">facebook</span></a>
                <a href="#" class="text-sky-400 hover:text-sky-700"><span class="material-symbols-outlined">twitter</span></a>
                <a href="#" class="text-pink-500 hover:text-pink-700"><span class="material-symbols-outlined">instagram</span></a>
            </div>
            <div>
                <a href="#contact" class="text-emerald-600 dark:text-emerald-400 hover:underline font-semibold">Contact Us</a>
            </div>
        </div>
    </footer>
@endsection
