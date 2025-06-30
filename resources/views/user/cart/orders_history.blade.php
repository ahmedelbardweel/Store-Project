@extends('layouts.app')

@section('content')
    <div class="pt-5">

        <div class="flex items-center gap-3 mb-8">
            <span class="text-3xl">🧾</span>
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-emerald-700 dark:text-emerald-300">
                My Previous Orders
            </h2>
        </div>

        @if($orders->isEmpty())
            <div class="bg-yellow-100 dark:bg-yellow-950 text-yellow-800 dark:text-yellow-200 py-12 px-6 rounded-3xl text-center text-xl shadow font-semibold flex flex-col items-center gap-2">
                <span class="text-5xl mb-2">📦</span>
                You have no previous orders.
            </div>
        @else
            <div class="flex flex-col gap-6">
                @foreach($orders as $order)
                    <div class="bg-white dark:bg-gray-900 shadow border border-emerald-100 dark:border-gray-800 px-5 py-6 flex flex-col gap-3" style="border-radius:0;">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-lg text-gray-800 dark:text-gray-200">Order #{{ $order->id }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <div>
                                <span class="text-gray-600 dark:text-gray-300">Total:</span>
                                <span class="font-extrabold text-emerald-700 dark:text-emerald-200 text-lg">{{ number_format($order->total, 2) }} $</span>
                            </div>
                            <div>
                                @if($order->status == 'completed')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 font-bold text-xs" style="border-radius:0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 font-bold text-xs" style="border-radius:0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2"/>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-blue-400 hover:bg-blue-600 text-white font-bold shadow transition text-sm"
                               style="border-radius:0;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                                View Details
                            </a>
                            @if($order->status == 'completed')
                                <a href="{{ route('orders.invoice', $order->id) }}" title="Download Invoice"
                                   class="w-10 h-10 flex items-center justify-center bg-white hover:bg-blue-100 dark:bg-white dark:hover:bg-white text-black border border-blue-100" style="border-radius:0;">
                                    <span class="material-symbols-outlined">download</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
