@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-bold mb-6">All Orders</h1>
    @if(session('success'))
        <div class="p-2 bg-green-100 text-green-700 border border-green-200 mb-4" style="border-radius:0">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($orders as $o)
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 shadow px-5 py-6 flex flex-col gap-4" style="border-radius:0;">
                <div class="flex justify-between items-center">
                    <div class="font-bold text-gray-800 dark:text-gray-200 text-lg">Order #{{ $o->id }}</div>
                    <a href="{{ route('admin.orders.show', $o) }}"
                       class="text-blue-700 bg-blue-100 hover:bg-blue-200 font-semibold px-4 py-1 transition"
                       style="border-radius:0">
                        Details
                    </a>
                </div>
                <div>
                    <span class="font-bold text-gray-700 dark:text-gray-100">User:</span>
                    <span class="text-emerald-800 dark:text-emerald-300">{{ $o->user->name ?? '--' }}</span>
                </div>
                <div>
                    <span class="font-bold text-gray-700 dark:text-gray-100">Subtotal:</span>
                    <span class="font-mono text-black dark:text-white">{{ $o->total }} $</span>
                </div>
                <div>
                    <span class="font-bold text-gray-700 dark:text-gray-100">Status:</span>
                    <form action="{{ route('admin.orders.update', $o) }}" method="POST" class="inline-block ml-2">
                        @csrf @method('PUT')
                        <select name="status"
                                onchange="this.form.submit()"
                                class="px-2 py-1 bg-white border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-600 text-gray-800 text-sm"
                                style="border-radius:0;">
                            <option value="pending"   @selected($o->status == 'pending')>Processing</option>
                            <option value="completed" @selected($o->status == 'completed')>Completed</option>
                            <option value="canceled"  @selected($o->status == 'canceled')>Canceled</option>
                        </select>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-20">No orders yet.</div>
        @endforelse
    </div>

    <div class="mt-8 flex justify-center">
        {{ $orders->links() }}
    </div>
@endsection
