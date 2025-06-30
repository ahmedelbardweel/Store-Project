@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 shadow p-6" style="border-radius:0;">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">My Profile</h2>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-1 px-3 py-1 bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-200 border border-emerald-200 dark:border-emerald-800 font-semibold text-sm hover:bg-emerald-200 hover:text-emerald-900 transition"
               style="border-radius:0;">
                <!-- أيقونة قلم التعديل SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 8.5-8.5z" />
                </svg>
                تعديل
            </a>
        </div>

        <div class="flex items-center gap-6 mb-8">
            <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=34d399&color=fff&rounded=false' }}"
                 alt="{{ $user->name }}"
                 class="w-32 h-32 object-cover border border-emerald-200 dark:border-emerald-800" style="border-radius:0;">
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
                        <div class="p-4 bg-gray-50 dark:bg-gray-900 shadow-sm border" style="border-radius:0;">
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
                                Subtotal: {{ $order->total }} {{ $order->currency ?? 'USD' }}
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
