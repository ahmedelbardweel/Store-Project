@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <h1 class="text-2xl font-black mb-4">Edit Product: {{ $product->name }}</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-none shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" class="max-w-xl">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description" class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price ($)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none" step="0.01" min="0">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Image URL</label>
            <input type="url" name="img" value="{{ old('img', $product->img) }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none">
        </div>

        <button type="submit"
                class="px-6 py-2 rounded-none bg-blue-600 text-white font-bold shadow hover:bg-blue-700 transition">
            Save Changes
        </button>
    </form>
@endsection
