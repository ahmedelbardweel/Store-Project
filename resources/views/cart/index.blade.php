@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-1xl">

        <div class="flex items-center mb-10 gap-3">
            <span class="text-4xl">🛒</span>
            <h2 class="text-3xl md:text-4xl font-black tracking-tight text-emerald-700 dark:text-emerald-300">Shopping Cart</h2>
        </div>

        {{-- رسائل النجاح أو الخطأ --}}
        @if(session('success'))
            <div class="mb-6 bg-green-300 dark:bg-emerald-950 border border-emerald-200 dark:border-emerald-700 text-emerald-900 dark:text-emerald-200 px-6 py-4 rounded-xl shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-700 text-red-900 dark:text-red-200 px-6 py-4 rounded-xl shadow">
                {{ session('error') }}
            </div>
        @endif

        @if($orderItems->isEmpty())
            <div class="bg-yellow-100 dark:bg-yellow-950 text-black dark:text-yellow-200 py-12 px-6 rounded-3xl text-center text-xl shadow font-semibold flex flex-col items-center gap-2">
                <span class="text-5xl mb-2">🪹</span>
                The cart is currently empty.
            </div>
        @else
            <div class="overflow-x-auto bg-white/95 dark:bg-gray-900/95 rounded-1xl shadow-xl ring-1 ring-emerald-100 dark:ring-gray-700">
                <table class="min-w-full text-center text-base">
                    <thead class="bg-blue-100 dark:bg-emerald-900/80">
                    <tr class="font-bold text-emerald-800 dark:text-emerald-300">
                        <th class="py-4 px-2">Product</th>
                        <th class="py-4 px-2">Price</th>
                        <th class="py-4 px-2">Quantity</th>
                        <th class="py-4 px-2">Subtotal</th>
                        <th class="py-4 px-2">Edit</th>
                        <th class="py-4 px-2">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderItems as $item)
                        <tr class="border-b border-emerald-50 dark:border-gray-700 hover:bg-emerald-50/40 dark:hover:bg-gray-800/70 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <div class="flex items-center gap-3 justify-center ">
                                    @if($item->product->img)
                                        <img src="{{ $item->product->img }}" alt="{{ $item->product->name }}"
                                             class="w-14 h-14 object-cover rounded-xl shadow border bg-white dark:bg-gray-800">
                                    @else
                                        <span class="w-14 h-14 flex items-center justify-center rounded-xl bg-gray-200 text-gray-500 text-xs">No Image</span>
                                    @endif
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->product->name }}</span>
                                </div>
                            </td>
                            <td class="py-5 px-2 font-semibold text-emerald-700 dark:text-emerald-300">
                                {{ number_format($item->price, 2) }} $
                            </td>
                            <td class="py-5 px-2 font-semibold">
                                {{ $item->quantity }}
                            </td>
                            <td class="py-5 px-2 font-bold text-emerald-700 dark:text-emerald-200">
                                {{ number_format($item->quantity * $item->price, 2) }} $
                            </td>
                            <!-- تعديل الكمية -->
                            <td class="py-5 px-2">
                                <div class="flex items-center gap-1 justify-center">
                                    <form action="{{ route('cart.decrease', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center bg-gray-200 dark:bg-gray-800 hover:bg-emerald-200 dark:hover:bg-emerald-900 rounded-xl text-xl font-bold shadow-sm transition">
                                            -
                                        </button>
                                    </form>
                                    <span class="mx-2 text-lg font-bold text-gray-800 dark:text-gray-200">{{ $item->quantity }}</span>
                                    <form action="{{ route('cart.increase', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center bg-gray-200 dark:bg-gray-800 hover:bg-emerald-200 dark:hover:bg-emerald-900 rounded-xl text-xl font-bold shadow-sm transition">
                                            +
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <!-- حذف -->
                            <td class="py-5 px-2 font-semibold">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="justify-self: center;">
                                    @csrf
                                    <button type="submit"
                                            class="rounded-xl bg-red-300 p-2 font-bold"
                                            title="Remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- بطاقة الإجمالي والأزرار أسفل الجدول بنفس العرض -->
                <div class="w-full mt-0">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6 bg-emerald-50 dark:bg-gray-800 border-t border-emerald-100 dark:border-gray-700 rounded-b-2xl px-6 py-6">
                        <!-- الإجمالي -->
                        <div class="flex items-center gap-3">
                            <span class="text-lg md:text-xl font-bold text-emerald-700 dark:text-emerald-200">Grand total:</span>
                            <span class="text-2xl md:text-3xl font-extrabold text-emerald-900 dark:text-emerald-100">{{ number_format($total, 2) }} $</span>
                        </div>
                        <!-- الأزرار -->
                        <div class="flex gap-4 mt-5 md:mt-0">
                            <form action="{{ route('cart.empty') }}" method="POST" onsubmit="return confirm('Are you sure to empty the basket?');">
                                @csrf
                                <button type="submit"
                                        class="px-6 py-2 bg-red-300 hover:bg-red-400 text-black rounded-xl font-bold shadow transition">
                                    Empty the basket
                                </button>
                            </form>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-6 py-2 bg-blue-400 from-emerald-400 to-blue-400 hover:from-emerald-500 hover:to-blue-500 text-black rounded-xl font-bold shadow transition">
                                    Complete the Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- نهاية البطاقة -->
            </div>
        @endif
    </div>
@endsection
