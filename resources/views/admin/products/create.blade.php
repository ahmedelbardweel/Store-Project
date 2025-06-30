@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
    <h1 class="text-2xl font-black mb-6">Add New Product</h1>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-none shadow-sm">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" class="max-w-xl">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1 font-semibold">Description</label>
            <textarea name="description" id="description"
                      class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="slug" class="block mb-1 font-semibold">Category (Slug)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none">
            <small class="text-gray-500">You can leave this blank.</small>
        </div>

        <div class="mb-4">
            <label for="price" class="block mb-1 font-semibold">Price ($)</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none" step="0.01" min="0" required>
        </div>

        <div class="mb-4">
            <label for="img" class="block mb-1 font-semibold">Image URL</label>
            <input type="url" name="img" id="img" value="{{ old('img') }}"
                   class="w-full border border-gray-300 px-3 py-2 rounded-none shadow-sm focus:ring-2 focus:ring-emerald-300 focus:outline-none">
            <small class="text-gray-500">You can use a direct image link from the web.</small>
        </div>

        <button type="submit" class="px-6 py-2 rounded-none bg-blue-600 text-white font-bold shadow hover:bg-blue-700 transition">
            Add Product
        </button>
    </form>
@endsection
