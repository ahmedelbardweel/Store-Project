@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-bold mb-4">كل الطلبات</h1>
    @if(session('success'))
        <div class="p-2 bg-green-100 text-green-700">{{ session('success') }}</div>
    @endif
    <table class="w-full text-center bg-white rounded shadow">
        <thead>
        <tr>
            <th>#</th>
            <th>المستخدم</th>
            <th>الإجمالي</th>
            <th>الحالة</th>
            <th>تفاصيل</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $o)
            <tr>
                <td>{{ $o->id }}</td>
                <td>{{ $o->user->name ?? '' }}</td>
                <td>{{ $o->total }}</td>
                <td>
                    <form action="{{ route('admin.orders.update', $o) }}" method="POST">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending"   @selected($o->status == 'pending')>قيد التنفيذ</option>
                            <option value="completed" @selected($o->status == 'completed')>مكتمل</option>
                            <option value="canceled"  @selected($o->status == 'canceled')>ملغى</option>
                        </select>
                    </form>
                </td>
                <td class="py-5">
                    <a href="{{ route('admin.orders.show', $o) }}" class="text-blue-700 bg-blue-100 hover:bg-blue-200 py-2 px-4 rounded-xl font-semibold transition">عرض التفاصيل</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
