@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-emerald-700">Order details :: {{ $order->id }}</h2>

        <div class="mb-6">
            <div class="text-gray-700 dark:text-gray-200">the condition:
                <span class="font-bold px-3 py-1 rounded-xl {{ $order->status == 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $order->status == 'pending' ? 'Pending' : 'complete' }}
            </span>
            </div>
            <div class="text-gray-700 dark:text-gray-200"> Order date:<b>{{ $order->created_at->format('Y-m-d H:i') }}</b></div>
            <div class="text-gray-700 dark:text-gray-200"> Grand total:<b>{{ number_format($order->total, 2) }} $</b></div>
        </div>

        <div class="overflow-x-auto rounded-xl shadow bg-white dark:bg-gray-900">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-right">
                <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-xs font-bold">Product</th>
                    <th class="px-6 py-3 text-xs font-bold">the price</th>
                    <th class="px-6 py-3 text-xs font-bold">Quantity</th>
                    <th class="px-6 py-3 text-xs font-bold">Subtotal</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-4 flex items-center gap-3">
                            @if($item->product && $item->product->img)
                                <img src="{{ $item->product->img }}" alt="{{ $item->product->name }}"
                                     class="w-12 h-12 rounded-xl shadow border object-cover">
                            @endif
                            <span>{{ $item->product->name ?? 'Deleted product' }}</span>
                        </td>
                        <td class="px-6 py-4">{{ number_format($item->price, 2) }} $</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4">{{ number_format($item->quantity * $item->price, 2) }} $</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('orders.history') }}" class="text-emerald-600 hover:underline font-bold">&larr;Return to previous orders</a>
        </div>
    </div>
@endsection
