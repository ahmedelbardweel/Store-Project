@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold mb-4">My Profile</h2>

        <div class="flex items-center space-x-6">
            <img src="{{ $user->avatar_url ?? 'https://via.placeholder.com/150' }}"
                 alt="{{ $user->name }}"
                 class="w-32 h-32 rounded-full object-cover">
            <div>
                <p class="text-lg font-medium">{{ $user->name }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Role: {{ $user->role ?? '–' }}
                </p>
            </div>
        </div>

        {{-- قسم الطلبات --}}
        <div class="mt-10">
            <h3 class="text-xl font-semibold mb-3 text-emerald-700 dark:text-emerald-300">طلباتك المكتملة</h3>
            @if($orders->count())
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg shadow-sm border">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold">طلب رقم: #{{ $order->id }}</span>
                                <span class="text-sm text-gray-500">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <ul class="ml-4 list-disc text-gray-700 dark:text-gray-300">
                                @foreach($order->orderItems as $item)
                                    <li>
                                        {{ $item->product->name ?? 'منتج محذوف' }}
                                        × {{ $item->quantity }}
                                        <span class="text-sm text-gray-500">({{ $item->price }} لكل واحدة)</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-end mt-2 text-emerald-700 dark:text-emerald-400 font-semibold">
                                الإجمالي: {{ $order->total }} {{ $order->currency ?? 'USD' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">لا يوجد لديك طلبات مكتملة حتى الآن.</p>
            @endif
        </div>
    </div>
@endsection
