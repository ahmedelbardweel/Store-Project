@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-6">تفاصيل الطلب رقم #{{ $order->id }}</h1>

        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6 mb-8">
            <p><span class="font-bold">العميل:</span> {{ $order->user->name ?? '---' }}</p>
            <p><span class="font-bold">الإيميل:</span> {{ $order->user->email ?? '---' }}</p>
            <p><span class="font-bold">الإجمالي:</span> {{ $order->total }} $</p>
            <p><span class="font-bold">الحالة:</span>
                @if($order->status === 'completed')
                    <span class="text-green-700 font-semibold">مكتمل</span>
                @else
                    <span class="text-yellow-700 font-semibold">قيد التنفيذ</span>
                @endif
            </p>
            <p><span class="font-bold">تاريخ الطلب:</span> {{ $order->created_at }}</p>
        </div>

        {{-- تفاصيل المنتجات في الطلب --}}
        <div class="bg-gray-50 dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">منتجات الطلب:</h2>
            @if($order->items && count($order->items))
                <table class="w-full text-right border">
                    <thead>
                    <tr>
                        <th class="p-2">المنتج</th>
                        <th class="p-2">السعر</th>
                        <th class="p-2">الكمية</th>
                        <th class="p-2">الإجمالي</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr class="border-b">
                            <td class="py-2">{{ $item->product->name ?? '---' }}</td>
                            <td class="py-2">{{ $item->price }}</td>
                            <td class="py-2">{{ $item->quantity }}</td>
                            <td class="py-2">{{ $item->price * $item->quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 text-center">لا توجد منتجات في هذا الطلب</p>
            @endif
        </div>

        {{-- زر العودة --}}
        <div class="mt-6">
            <a href="{{ route('admin.orders.index') }}"
               class="bg-blue-200 hover:bg-emerald-700 text-black py-2 px-4 rounded-xl font-semibold transition">
                ← رجوع لقائمة الطلبات
            </a>
        </div>
    </div>
@endsection
