@extends('layouts.admin')

@section('title', 'تعديل منتج')

@section('content')
    <h1 class="text-2xl font-bold mb-4">تعديل المنتج: {{ $product->name }}</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">اسم المنتج</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border px-3 py-2 rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">الوصف</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded-lg">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">السعر</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                   class="w-full border px-3 py-2 rounded-lg" step="0.01">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">رابط الصورة</label>
            <input type="url" name="img" value="{{ old('img', $product->img) }}"
                   class="w-full border px-3 py-2 rounded-lg">
        </div>

        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-emerald-800 transition">
            حفظ التعديلات
        </button>
    </form>
@endsection
