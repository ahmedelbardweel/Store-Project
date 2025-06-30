@extends('layouts.admin')

@section('content')
    <div class="p-6 sm:p-10 max-w-3xl mx-auto">
        <h1 class="text-2xl font-black mb-6">Order Details #{{ $order->id }}</h1>

        {{-- معلومات الطلب --}}
        <div class="bg-white dark:bg-gray-900 shadow border border-gray-200 dark:border-gray-800 mb-6 px-6 py-5 flex flex-col gap-2" style="border-radius:0">
            <div><b>Customer:</b> {{ $order->user->name ?? '---' }}</div>
            <div><b>Email:</b> {{ $order->user->email ?? '---' }}</div>
            <div><b>Subtotal:</b> <span class="font-mono">{{ $order->total }} $</span></div>
            <div>
                <b>Status:</b>
                @if($order->status === 'completed')
                    <span class="text-green-700 font-semibold">Completed</span>
                @elseif($order->status === 'canceled')
                    <span class="text-red-700 font-semibold">Canceled</span>
                @else
                    <span class="text-yellow-700 font-semibold">Processing</span>
                @endif
            </div>
            <div><b>Order Date:</b> {{ $order->created_at->format('Y-m-d H:i') }}</div>
        </div>

        {{-- المنتجات في الطلب --}}
        <h2 class="font-bold text-lg mb-4">Order Products:</h2>
        @if($order->items && count($order->items))
            <div class="grid gap-5 md:grid-cols-2">
                @foreach($order->items as $item)
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow px-5 py-4 flex flex-col sm:flex-row gap-4 items-center" style="border-radius:0">
                        <div class="w-28 h-28 flex-shrink-0 flex items-center justify-center border border-gray-100 dark:border-gray-700 bg-white" style="border-radius:0">
                            <img src="{{ $item->product->img ?? 'https://via.placeholder.com/90' }}"
                                 alt="{{ $item->product->name ?? '' }}"
                                 class="object-contain w-20 h-20" style="border-radius:0">
                        </div>
                        <div class="flex-1 flex flex-col justify-between gap-1 text-center sm:text-left">
                            <div class="font-bold text-emerald-800 dark:text-emerald-200 text-base mb-1">{{ $item->product->name ?? '---' }}</div>
                            <div class="text-gray-700 dark:text-gray-300 text-sm">Price: <b>{{ $item->price }} $</b></div>
                            <div class="text-gray-700 dark:text-gray-300 text-sm">Quantity: <b>{{ $item->quantity }}</b></div>
                            <div class="text-gray-900 dark:text-white font-bold">Subtotal: {{ $item->price * $item->quantity }} $</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">No products in this order</p>
        @endif

        <div class="mt-7">
            <a href="{{ route('admin.orders.index') }}"
               class="bg-blue-200 hover:bg-emerald-700 text-black font-semibold py-2 px-4 border border-gray-200 dark:border-gray-700 shadow transition"
               style="border-radius:0">
                &larr; Back to Orders List
            </a>
        </div>
    </div>
@endsection
