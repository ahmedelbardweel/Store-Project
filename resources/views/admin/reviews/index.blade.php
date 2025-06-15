@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-bold mb-4">تقييمات العملاء</h1>
    <table class="w-full text-center bg-white rounded shadow">
        <thead>
        <tr>
            <th>#</th>
            <th>المستخدم</th>
            <th>التقييم</th>
            <th>التعليق</th>
            <th>التاريخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->user->name ?? '' }}</td>
                <td>{{ $r->rating }}</td>
                <td>{{ $r->comment }}</td>
                <td>{{ $r->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $reviews->links() }}
@endsection
