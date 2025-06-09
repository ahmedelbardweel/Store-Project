@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-4xl px-4 py-10">

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
            <div class="overflow-x-auto bg-white/95 dark:bg-gray-900/95 rounded-2xl shadow-xl ring-1 ring-emerald-100 dark:ring-gray-700">
                <table class="min-w-full text-center text-base">
                    <thead class="bg-emerald-50 dark:bg-emerald-900/80">
                    <tr class="font-bold text-emerald-800 dark:text-emerald-300">
                        <th class="py-4 px-2">Order #</th>
                        <th class="py-4 px-2">Date</th>
                        <th class="py-4 px-2">Total ($)</th>
                        <th class="py-4 px-2">Status</th>
                        <th class="py-4 px-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b border-emerald-50 dark:border-gray-700 hover:bg-emerald-50/40 dark:hover:bg-gray-800/70 transition">
                            <td class="py-5 px-2 font-semibold text-gray-800 dark:text-gray-200">
                                #{{ $order->id }}
                            </td>
                            <td class="py-5 px-2 text-gray-700 dark:text-gray-300">
                                {{ $order->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="py-5 px-2 font-bold text-emerald-700 dark:text-emerald-200">
                                {{ number_format($order->total, 2) }}
                            </td>
                            <td class="py-5 px-2">
                                @if($order->status == 'completed')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-300 rounded-xl font-semibold text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-xl font-semibold text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2 2"/>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="py-5 px-2 flex justify-center gap-2">
                                <!-- View Details button -->
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="inline-flex items-center gap-1 px-4 py-2 bg-blue-400 hover:bg-blue-600 text-white rounded-xl font-bold shadow transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m6 0a6 6 0 11-12 0 6 6 0 0112 0z" />
                                    </svg>
                                    View Details
                                </a>
                                <!-- Download Invoice icon button (Only if Completed) -->
                                @if($order->status == 'completed')
                                    <a href="{{ route('orders.invoice', $order->id) }}" title="Download Invoice"
                                       class="w-9 h-9 flex items-center justify-center bg-white hover:bg-blue-100 dark:bg-white dark:hover:bg-white text-black rounded-xl">
                                        <span class="material-symbols-outlined">
                                            download
                                        </span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
