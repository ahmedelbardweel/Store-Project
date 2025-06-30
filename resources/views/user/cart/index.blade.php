@extends('layouts.app')

@section('content')
    <div class="pt-12 pb-40 mx-auto">
        <div class="flex items-center mb-10 gap-3">
            <h2 class="text-3xl md:text-4xl font-black tracking-tight text-emerald-700 dark:text-emerald-300">Shopping Cart</h2>
        </div>

        {{-- رسائل النجاح أو الخطأ --}}
        @if(session('success'))
            <div class="mb-6 bg-gray-300 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-700 text-emerald-900 dark:text-emerald-200 px-6 py-4 rounded-xl shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-700 text-red-900 dark:text-red-200 px-6 py-4 rounded-xl shadow">
                {{ session('error') }}
            </div>
        @endif

        @if($orderItems->isEmpty())
            <div class="bg-yellow-50 dark:bg-yellow-950 text-black dark:text-yellow-200 py-12 px-6 rounded-3xl text-center text-xl shadow font-semibold flex flex-col items-center gap-2">
                <span class="text-5xl mb-2">🪹</span>
                The cart is currently empty.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($orderItems as $item)
                    <div class="bg-white dark:bg-gray-900 border border-emerald-100 dark:border-gray-800 shadow flex flex-col items-stretch px-0 pb-4" style="border-radius:0;min-height:330px;">
                        {{-- صورة المنتج كوفر --}}
                        <div class="w-full h-40 flex items-center justify-center border-b border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800" style="border-radius:0;">
                            @if($item->product->img)
                                <img src="{{ $item->product->img }}" alt="{{ $item->product->name }}"
                                     class="object-contain h-32 max-w-full mx-auto block" style="border-radius:0;">
                            @else
                                <span class="w-20 h-20 flex items-center justify-center bg-gray-200 text-gray-500 text-xs" style="border-radius:0;">No Image</span>
                            @endif
                        </div>
                        {{-- باقي التفاصيل --}}
                        <div class="flex flex-col flex-1 justify-between items-center px-4 mt-4 gap-2">
                            <div class="font-bold text-gray-900 dark:text-gray-100 text-center w-full">{{ $item->product->name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-300 text-center w-full">{{ number_format($item->price, 2) }} $</div>
                            <div class="flex items-center gap-3 justify-center w-full mt-3">
                                <form action="{{ route('cart.decrease', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-gray-200 dark:bg-gray-800 hover:bg-emerald-200 dark:hover:bg-emerald-900 text-xl font-bold shadow-sm transition" style="border-radius:0;">
                                        -
                                    </button>
                                </form>
                                <span class="mx-2 text-lg font-bold text-gray-800 dark:text-gray-200">{{ $item->quantity }}</span>
                                <form action="{{ route('cart.increase', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center bg-gray-200 dark:bg-gray-800 hover:bg-emerald-200 dark:hover:bg-emerald-900 text-xl font-bold shadow-sm transition" style="border-radius:0;">
                                        +
                                    </button>
                                </form>
                            </div>
                            <div class="font-bold text-emerald-700 dark:text-emerald-200 min-w-[70px] text-center w-full mt-2">
                                {{ number_format($item->quantity * $item->price, 2) }} $
                            </div>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="w-full flex justify-center mt-2">
                                @csrf
                                <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center bg-red-100 hover:bg-red-300 text-red-600 shadow transition" style="border-radius:0;"
                                        title="Remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- الشريط الثابت في الأسفل --}}
    @if(!$orderItems->isEmpty())
        <div class="fixed bottom-0 left-0 w-full z-50 bg-white dark:bg-gray-900/90 border-t border-emerald-100 dark:border-gray-800 shadow-xl pt-5 pb-20 px-2"
             style="backdrop-filter: blur(4px);">
            <div class="max-w-2xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <span class="text-lg md:text-xl font-bold text-emerald-700 dark:text-emerald-200">Grand total:</span>
                    <span class="text-2xl md:text-3xl font-extrabold text-green-700 dark:text-emerald-100">{{ number_format($total, 2) }} $</span>
                </div>
                <div class="flex flex-wrap gap-4 mt-3 md:mt-0">
                    <form action="{{ route('cart.empty') }}" method="POST" onsubmit="return confirm('Are you sure to empty the basket?');">
                        @csrf
                        <button type="submit"
                                class="px-6 py-2 bg-red-100 hover:bg-red-200 text-black font-bold shadow transition"
                                style="border-radius:0;">
                            Empty the basket
                        </button>
                    </form>
                    <form action="{{ route('stripe.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold shadow transition" style="border-radius:0;">
                            الدفع عبر Stripe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection
