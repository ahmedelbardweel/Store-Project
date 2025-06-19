@extends('layouts.admin')
@section('title', 'لوحة تحكم الأدمن')

@section('content')
    <div>
        <div class="flex flex-col md:flex-row md:justify-between items-start gap-8 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-emerald-800 dark:text-emerald-300 tracking-tight flex items-center gap-2">
                    <span class="bg-emerald-200 dark:bg-emerald-800 text-emerald-900 dark:text-emerald-100 rounded-full px-3 py-1 text-2xl">👑</span>
                    لوحة تحكم الأدمن
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2 text-base" style="font-size: 14px">تحكم في المنتجات، الطلبات، العملاء والتقارير عبر لوحة احترافية واحدة.</p>
            </div>
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 bg-blue-300 from-emerald-600 to-blue-600 hover:from-emerald-800 hover:to-blue-700 text-black font-bold py-2.5 px-7 rounded-xl shadow-md hover:shadow-lg transition-all text-base">
                <span class="material-symbols-outlined" style="font-size: 14px">add_circle</span>
                إضافة منتج جديد
            </a>
        </div>

        {{-- === Cards إحصائيات سريعة === --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12" style="font-size: 14px">
            <div class="bg-blue-100 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 rounded-2xl shadow group hover:shadow-2xl transition p-5 flex flex-col items-center justify-center">
                <div class="bg-blue-50 dark:bg-blue-900 rounded-2xl p-4 mb-2">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-300">inventory_2</span>
                </div>
                <div class=" font-bold text-gray-900 dark:text-emerald-200 text-3xl">{{ $productsCount ?? '--' }}</div>
                <div class="text-gray-600 dark:text-gray-400 text-xl">عدد منتج</div>
            </div>
            <div class="bg-green-900 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 rounded-2xl shadow group hover:shadow-2xl transition p-5 flex flex-col items-center justify-center">
                <div class="bg-white dark:bg-emerald-900 rounded-2xl p-4 mb-2">
                    <span class="material-symbols-outlined text-green-800 dark:text-blue-200">shopping_cart</span>
                </div>
                <div class="text-3xl font-bold text-white dark:text-emerald-200">{{ $ordersCount ?? '--' }}</div>
                <div class="text-white dark:text-gray-400 text-xl">طلب</div>
            </div>
            <div class="bg-yellow-700 bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 rounded-2xl shadow group hover:shadow-2xl transition p-5 flex flex-col items-center justify-center">
                <div class="bg-pink-50 dark:bg-pink-900 rounded-2xl p-4 mb-2">
                    <span class="material-symbols-outlined  dark:text-pink-300">people</span>
                </div>
                <div class="text-3xl font-bold text-white dark:text-emerald-200">{{ $usersCount ?? '--' }}</div>
                <div class="text-white dark:text-gray-400 text-xl">عميل مسجل</div>
            </div>
            <div class="bg-yellow-100  bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 rounded-2xl shadow group hover:shadow-2xl transition p-5 flex flex-col items-center justify-center">
                <div class="bg-yellow-50 dark:bg-yellow-800 rounded-2xl p-4 mb-2">
                    <span class="material-symbols-outlined text-yellow-500 dark:text-yellow-200">attach_money</span>
                </div>
                <div class="text-3xl font-bold text-gray-900 dark:text-emerald-200">{{ number_format($totalSales ?? 0) }} $
                </div>
                <div class="text-gray-600 dark:text-gray-400 text-xl">إجمالي المبيعات</div>
            </div>
        </div>
    </div>

    {{-- === آخر المنتجات === --}}
    <div class="mb-12">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-200 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500">inventory_2</span>
                آخر المنتجات
            </h2>
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:underline text-sm font-bold">عرض كل المنتجات</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($latestProducts as $product)
                <div class="bg-gradient-to-br from-emerald-50 to-white dark:from-emerald-900 dark:to-gray-900 border border-emerald-100 dark:border-emerald-900 rounded-2xl p-0 shadow group hover:shadow-2xl transition flex flex-col overflow-hidden">
                    {{-- الصورة بعرض البطاقة كله، بارتفاع ثابت --}}
                    <div class="w-full aspect-w-16 h-40 bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center">
                        <img src="{{ $product->img }}"
                             alt="{{ $product->name }}"
                             class="object-cover w-full h-full transition group-hover:scale-105 duration-300 rounded-t-2xl shadow"
                        >
                    </div>
                    {{-- تفاصيل المنتج --}}
                    <div class="flex-1 flex flex-col items-center justify-center p-5">
                        <div class="font-extrabold text-emerald-900 dark:text-emerald-100 text-center mb-1 text-lg">
                            {{ $product->name }}
                        </div>
                        <div class="text-base text-gray-700 mb-2 dark:text-gray-400 text-center font-semibold">
                            {{ $product->price }} $
                        </div>
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-1 text-xs font-bold shadow transition">
                            تعديل
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-400">لا يوجد منتجات حديثة</div>
            @endforelse
        </div>
    </div>

    {{-- === آخر الطلبات === --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-emerald-700 dark:text-emerald-200 flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-500">shopping_cart</span>
                آخر الطلبات
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm font-bold">كل الطلبات</a>
        </div>
        <div class="overflow-x-auto rounded-xl shadow">
            <table class="min-w-full bg-white dark:bg-gray-900 rounded-xl text-right">
                <thead>
                <tr class="bg-emerald-100 dark:bg-emerald-800 text-emerald-900 dark:text-white">
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">العميل</th>
                    <th class="py-3 px-4">الإجمالي</th>
                    <th class="py-3 px-4">الحالة</th>
                    <th class="py-3 px-4">تاريخ الطلب</th>
                    <th class="py-3 px-4">إدارة</th>
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
                                <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-extrabold">مكتمل</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-extrabold">قيد التنفيذ</span>
                            @endif
                        </td>
                        <td class="py-2 px-4">{{ $order->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="text-blue-600 hover:underline font-bold text-xs">عرض التفاصيل</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-6 text-gray-400">لا يوجد طلبات حديثة</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
@endpush
