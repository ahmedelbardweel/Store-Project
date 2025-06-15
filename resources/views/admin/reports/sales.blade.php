@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-bold mb-4">إحصائيات المبيعات</h1>
    <div class="mb-4 bg-white p-4 rounded shadow">
        <p>إجمالي المبيعات: <b>{{ $totalSales }}</b></p>
        <p>عدد الطلبات المكتملة: <b>{{ $ordersCount }}</b></p>
        {{-- يمكنك هنا إضافة رسم بياني عبر chart.js --}}
    </div>
    {{-- جدول تفصيلي --}}
    <table class="w-full text-center bg-white rounded shadow">
        <thead>
        <tr>
            <th>#</th>
            <th>المستخدم</th>
            <th>المبلغ</th>
            <th>التاريخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($completedOrders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->user->name ?? '' }}</td>
                <td>{{ $o->total }}</td>
                <td>{{ $o->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
