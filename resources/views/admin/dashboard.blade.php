@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
    <div>
        <div class="flex flex-col md:flex-row md:justify-between items-start gap-8 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-emerald-800 dark:text-emerald-300 tracking-tight flex items-center gap-2">
                    Admin Dashboard
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2 text-base" style="font-size: 14px">
                    Manage products, orders, clients, and reports in one professional dashboard.
                </p>
            </div>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 bg-blue-300 from-emerald-600 to-blue-600 hover:from-emerald-800 hover:to-blue-700 text-black font-bold py-2.5 px-7 shadow-md hover:shadow-lg transition-all text-base"
               style="border-radius:0">
                <span class="material-symbols-outlined" style="font-size: 14px">add_circle</span>
                Add New Product
            </a>
        </div>

        {{-- === Quick Stats Cards === --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12" style="font-size: 14px">
            <div class="bg-blue-100 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 shadow group hover:shadow-2xl transition p-10 flex flex-col items-center justify-center" style="border-radius:0">
                <div class="bg-blue-50 dark:bg-blue-900 p-4 mb-2" style="border-radius:0">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-300">inventory_2</span>
                </div>
                <div class=" font-bold text-gray-900 dark:text-emerald-200 text-3xl">{{ $productsCount ?? '--' }}</div>
                <div class="text-gray-600 dark:text-gray-400 text-xl">Products</div>
            </div>
            <div class="bg-green-900 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 shadow group hover:shadow-2xl transition p-10 flex flex-col items-center justify-center" style="border-radius:0">
                <div class="bg-white dark:bg-emerald-900 p-4 mb-2" style="border-radius:0">
                    <span class="material-symbols-outlined text-green-800 dark:text-blue-200">shopping_cart</span>
                </div>
                <div class="text-3xl font-bold text-white dark:text-emerald-200">{{ $ordersCount ?? '--' }}</div>
                <div class="text-white dark:text-gray-400 text-xl">Orders</div>
            </div>
            <div class="bg-yellow-700 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 shadow group hover:shadow-2xl transition p-10 flex flex-col items-center justify-center" style="border-radius:0">
                <div class="bg-pink-50 dark:bg-pink-900 p-4 mb-2" style="border-radius:0">
                    <span class="material-symbols-outlined  dark:text-pink-300">people</span>
                </div>
                <div class="text-3xl font-bold text-white dark:text-emerald-200">{{ $usersCount ?? '--' }}</div>
                <div class="text-white dark:text-gray-400 text-xl">Registered Clients</div>
            </div>
            <div class="bg-yellow-100  bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 shadow group hover:shadow-2xl transition p-10 flex flex-col items-center justify-center" style="border-radius:0">
                <div class="bg-yellow-50 dark:bg-yellow-800 p-4 mb-2" style="border-radius:0">
                    <span class="material-symbols-outlined text-yellow-500 dark:text-yellow-200">attach_money</span>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-emerald-200">{{ number_format($totalSales ?? 0) }} $
                </div>
                <div class="text-gray-600 dark:text-gray-400 text-xl">Total Sales</div>
            </div>
        </div>
    </div>

    {{-- === Latest Products === --}}
    <div class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-200 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500">inventory_2</span>
                Latest Products
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:underline text-sm font-bold">View all products</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($latestProducts as $product)
                <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 p-0 shadow group hover:shadow-2xl transition flex flex-col overflow-hidden" style="border-radius:0">
                    <div class="w-full aspect-w-16 h-80 bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center" style="border-radius:0">
                        <img src="{{ $product->img }}"
                             alt="{{ $product->name }}"
                             class="object-fill p-10 w-full h-full transition group-hover:scale-105 duration-300" style="border-radius:0"
                        >
                    </div>
                    <div class="flex-1 flex flex-col items-center justify-center p-5">
                        <div class="font-extrabold text-emerald-900 dark:text-emerald-100 text-center mb-1 text-lg">
                            {{ $product->name }}
                        </div>
                        <div class="text-base text-gray-700 mb-2 dark:text-gray-400 text-center font-semibold">
                            {{ $product->price }} $
                        </div>
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 text-xs font-bold shadow transition" style="border-radius:0">
                            Edit
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-400">No recent products</div>
            @endforelse
        </div>
    </div>

    {{-- === Latest Orders === --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-200 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500">shopping_cart</span>
                Latest Orders
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm font-bold">All Orders</a>
        </div>
        <div class="overflow-x-auto shadow" style="border-radius:0">
            <table class="min-w-full bg-white dark:bg-gray-900 text-right" style="border-radius:0">
                <thead>
                <tr class="bg-emerald-100 dark:bg-emerald-800 text-emerald-900 dark:text-white">
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">Client</th>
                    <th class="py-3 px-4">Subtotal</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Order Date</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($latestOrders as $order)
                    <tr class="border-b dark:border-gray-700 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition">
                        <td class="py-2 px-4">{{ $order->id }}</td>
                        <td class="py-2 px-4">{{ $order->user->name ?? '---' }}</td>
                        <td class="py-2 px-4 font-bold">{{ number_format($order->total ) }} $</td>
                        <td class="py-2 px-4">
                            @if($order->status === 'completed')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-extrabold" style="border-radius:0">Completed</span>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-extrabold" style="border-radius:0">Processing</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="text-blue-600 hover:underline font-bold text-xs">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-6 text-gray-400">No recent orders</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
@endpush
