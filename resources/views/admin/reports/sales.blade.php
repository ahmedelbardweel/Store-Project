@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-black mb-4">Sales Statistics</h1>
    <div class="mb-6 bg-white dark:bg-gray-900 p-5 rounded-none shadow border">
        <p>Total Sales: <b class="text-emerald-700 dark:text-emerald-300">${{ $totalSales }}</b></p>
        <p>Completed Orders: <b class="text-blue-700 dark:text-blue-300">{{ $ordersCount }}</b></p>
        {{-- You can add a chart here using Chart.js --}}
    </div>

    {{-- Responsive Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-center bg-white dark:bg-gray-900 rounded-none shadow border">
            <thead class="bg-emerald-50 dark:bg-gray-800">
            <tr>
                <th class="py-3 px-2 border-b font-semibold text-sm text-gray-700 dark:text-gray-300">#</th>
                <th class="py-3 px-2 border-b font-semibold text-sm text-gray-700 dark:text-gray-300">User</th>
                <th class="py-3 px-2 border-b font-semibold text-sm text-gray-700 dark:text-gray-300">Amount</th>
                <th class="py-3 px-2 border-b font-semibold text-sm text-gray-700 dark:text-gray-300">Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($completedOrders as $o)
                <tr class="hover:bg-emerald-50 dark:hover:bg-gray-800">
                    <td class="py-2 px-2 border-b">{{ $o->id }}</td>
                    <td class="py-2 px-2 border-b">{{ $o->user->name ?? '-' }}</td>
                    <td class="py-2 px-2 border-b font-bold text-emerald-700 dark:text-emerald-300">${{ $o->total }}</td>
                    <td class="py-2 px-2 border-b">{{ $o->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
