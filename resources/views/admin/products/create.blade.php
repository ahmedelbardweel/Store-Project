@extends('layouts.admin')

@section('title', 'إضافة منتج جديد')

@section('content')
    <h1 class="text-2xl font-bold mb-6">إضافة منتج جديد</h1>

    {{-- عرض أخطاء التحقق --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">اسم المنتج</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border px-3 py-2 rounded-lg" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold">الوصف</label>
            <textarea name="description" id="description"
                      class="w-full border px-3 py-2 rounded-lg" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="slug" class="block mb-1 font-semibold">النوع/القسم (Slug)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                   class="w-full border px-3 py-2 rounded-lg">
            <small class="text-gray-500">يمكنك تركه فارغًا.</small>
        </div>

        <div class="mb-4">
            <label for="price" class="block mb-1 font-semibold">السعر</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                   class="w-full border px-3 py-2 rounded-lg" step="0.01" required>
        </div>

        <div class="mb-4">
            <label for="img" class="block mb-1 font-semibold">رابط الصورة (URL)</label>
            <input type="url" name="img" id="img" value="{{ old('img') }}"
                   class="w-full border px-3 py-2 rounded-lg">
            <small class="text-gray-500">يمكنك وضع رابط صورة مباشرة من الإنترنت.</small>
        </div>

        <button type="submit" class="px-6 py-2 rounded-lg bg-blue-400 text-white hover:bg-emerald-800 transition">
            إضافة المنتج
        </button>
    </form>
@endsection
