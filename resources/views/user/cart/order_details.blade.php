@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 max-w-fit">

        <h2 class="text-3xl font-black mb-6 text-emerald-700 dark:text-emerald-300">Order Details #{{ $order->id }}</h2>

        {{-- Order Info Card --}}
        <div class="bg-white dark:bg-gray-900 border border-emerald-700 dark:border-emerald-400 shadow mb-7 px-5 py-4 flex flex-col gap-2" style="border-radius:0;">
            <div class="flex flex-wrap gap-5 items-center">
                <span class="text-gray-700 dark:text-gray-200 font-semibold">Status:</span>
                <span class="font-bold px-3 py-1 text-xs uppercase tracking-wider
                    {{ $order->status == 'completed'
                        ? 'bg-emerald-100 text-emerald-700'
                        : ($order->status == 'canceled'
                            ? 'bg-red-100 text-red-700'
                            : 'bg-yellow-100 text-yellow-800')
                    }}"
                      style="border-radius:0;">
                    {{ ucfirst($order->status) }}
                </span>
                <span class="text-gray-700 dark:text-gray-200 font-semibold ml-auto">
                    Order Date:
                    <b>{{ $order->created_at->format('Y-m-d H:i') }}</b>
                </span>
            </div>
            <div class="text-gray-700 dark:text-gray-200 flex items-center gap-2">
                <span>Grand Total:</span>
                <b class="text-emerald-700 dark:text-emerald-200 text-lg">{{ number_format($order->total, 2) }} $</b>
            </div>
        </div>

        {{-- Each Product as a Card --}}
        <div class="flex flex-col gap-5">
            @foreach($order->items as $item)
                <div class="bg-white dark:bg-gray-900 border-2 border-gray-200 dark:border-gray-700 shadow flex flex-col gap-3 p-5" style="border-radius:0;">
                    <div class="flex items-center gap-4">
                        @if($item->product && $item->product->img)
                            <img src="{{ $item->product->img }}" alt="{{ $item->product->name }}"
                                 class="w-16 h-16 border border-gray-300 dark:border-gray-600" style="border-radius:0;">
                        @endif
                        <div>
                            <div class="font-bold text-gray-900 dark:text-gray-100 text-base mb-1">
                                {{ $item->product->name ?? 'Deleted product' }}
                            </div>
                            <div class="flex flex-col gap-1 mt-1 text-sm">
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300">Price:</span>
                                    <span class="font-bold text-emerald-700 dark:text-emerald-200">{{ number_format($item->price, 2) }} $</span>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300">Quantity:</span>
                                    <span class="font-bold">{{ $item->quantity }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-300">Subtotal:</span>
                                    <span class="font-bold">{{ number_format($item->quantity * $item->price, 2) }} $</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('orders.history') }}"
               class="inline-block text-emerald-700 dark:text-emerald-300 hover:underline font-bold text-base transition">
                &larr; Return to previous orders
            </a>
        </div>
    </div>
@endsection
