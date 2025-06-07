@extends('layouts.app')

@section('content')
    <div x-data="{ showSuccess: false }" class="max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-blue-700 dark:text-emerald-300 mb-8">Cart content</h2>

        @if (count($products) == 0)
            <div class="p-8 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-2xl text-center text-lg shadow-inner">
                The cart is empty! <br>
                browse <a href="{{ route('products.index') }}" class="text-emerald-600 font-bold underline hover:text-blue-600 transition">Products</a> وابدأ التسوق الآن.
            </div>
        @else
            <div class="overflow-x-auto bg-white dark:bg-gray-900 rounded-2xl shadow-lg">
                <table class="w-full min-w-[700px] text-center">
                    <thead>
                    <tr class="bg-blue-50 dark:bg-gray-800 text-blue-700 dark:text-emerald-300 text-lg">
                        <th class="py-4 font-semibold">Product</th>
                        <th class="py-4 font-semibold">Quantity</th>
                        <th class="py-4 font-semibold">Price</th>
                        <th class="py-4 font-semibold">Total</th>
                        <th class="py-4 font-semibold">Delete</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @php $total = 0; @endphp
                    @foreach ($products as $product)
                        @php $sum = $product->price * $cart[$product->id]; $total += $sum; @endphp
                        <tr class="hover:bg-emerald-50 dark:hover:bg-gray-800 transition">
                            <td class="py-4 px-2">
                                <div class="flex items-center gap-3 justify-center">
                                    <img src="{{ $product->img }}" alt="" class="w-14 h-14 rounded-xl border border-emerald-100 dark:border-gray-800 object-cover shadow-sm">
                                    <span class="font-semibold text-gray-700 dark:text-emerald-200">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-2">
                                    <form action="{{ route('cart.decrease', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-md text-lg font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition
                                                {{ $cart[$product->id] <= 1 ? 'opacity-30 cursor-not-allowed' : '' }}"
                                                @if($cart[$product->id] <= 1) disabled @endif>
                                            –
                                        </button>
                                    </form>
                                    <span class="font-bold text-lg">{{ $cart[$product->id] }}</span>
                                    <form action="{{ route('cart.increase', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded-md text-lg font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                            +
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="font-bold text-blue-700 dark:text-blue-300">{{ $product->price }} <span class="text-xs text-gray-400">$</span></td>
                            <td class="font-bold text-emerald-600 dark:text-emerald-300">{{ $sum }} <span class="text-xs text-gray-400">$</span></td>
                            <td>
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:underline font-bold transition px-3 py-1">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <!-- صف المجموع الكلي و زر إتمام الشراء -->
                    <tr class="bg-blue-50 dark:bg-gray-800 border-t-2 border-blue-200 dark:border-emerald-700 text-lg font-bold">
                        <td colspan="2" class="py-5 text-left px-6 text-blue-700 dark:text-emerald-200">
                            Grand total : {{ $total }}$
                        </td>
                        <td colspan="2" class="py-5 text-emerald-700 dark:text-blue-300 text-xl">
                            <span class="text-base text-gray-500"></span>
                        </td>
                        <td class="py-5 text-center">
                            <button @click="showSuccess = true"
                                    class="inline-block px-3 py-2 rounded-xl bg-gradient-to-r from-blue-500 via-emerald-500 to-blue-600 hover:from-emerald-600 hover:to-blue-700 text-white text-lg font-bold shadow-lg transition-all duration-200">
                                Complete your purchase
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            {{-- Success Modal --}}
            <div x-show="showSuccess" x-cloak class="fixed inset-0 flex items-center justify-center z-50 bg-black/40">
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl p-8 flex flex-col items-center min-w-[320px] relative animate-fadeInUp"
                     @click.away="showSuccess = false">
                    <svg class="w-20 h-20 mb-4 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" class="text-emerald-100 dark:text-emerald-800" fill="currentColor"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4" stroke="#22c55e" stroke-width="3" fill="none"/>
                    </svg>
                    <h3 class="text-xl font-bold text-emerald-700 dark:text-emerald-300 mb-3">Your purchase was successful!</h3>
                    <form id="empty-cart-form" action="{{ route('cart.empty') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full py-2 px-7 mt-3 rounded-lg bg-blue-500 hover:bg-emerald-500 text-white text-lg font-semibold shadow transition">
                            Done
                        </button>
                    </form>

                </div>
            </div>
            <style>
                [x-cloak] { display: none !important; }
                @keyframes fadeInUp {
                    0% { opacity: 0; transform: translateY(40px);}
                    100% { opacity: 1; transform: translateY(0);}
                }
                .animate-fadeInUp { animation: fadeInUp 0.5s cubic-bezier(.5,2,.5,1.5); }
            </style>
        @endif
    </div>
@endsection
