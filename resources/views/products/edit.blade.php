@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto my-12 bg-white/90 dark:bg-gray-800/95 rounded-2xl shadow-2xl p-8 border border-emerald-100 dark:border-gray-800 backdrop-blur-md">
        <h2 class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-300 mb-6 flex items-center gap-2">
            Edit Product
        </h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-600 text-red-700 dark:text-red-200 rounded-lg">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product->id) }}" class="space-y-7">
            @csrf
            @method('PUT')

            {{-- Product Name --}}
            <div>
                <label for="name" class="block mb-1 text-sm font-bold text-gray-700 dark:text-emerald-200">
                    Product Name
                </label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $product->name) }}"
                       required
                       class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-700 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block mb-1 text-sm font-bold text-gray-700 dark:text-emerald-200">
                    Description
                </label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-700 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block mb-1 text-sm font-bold text-gray-700 dark:text-emerald-200">
                    Slug
                </label>
                <input type="text" name="slug" id="slug"
                       value="{{ old('slug', $product->slug) }}"
                       class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-700 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">
            </div>

            {{-- Price --}}
            <div>
                <label for="price" class="block mb-1 text-sm font-bold text-gray-700 dark:text-emerald-200">
                    Price
                </label>
                <input type="number" name="price" id="price" step="0.01"
                       value="{{ old('price', $product->price) }}"
                       required
                       class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-700 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">
            </div>

            {{-- Image URL --}}
            <div>
                <label for="img" class="block mb-1 text-sm font-bold text-gray-700 dark:text-emerald-200">
                    Product Image URL
                </label>
                <input type="url" name="img" id="img" placeholder="https://example.com/image.jpg"
                       value="{{ old('img', $product->img) }}"
                       class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-700 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    You can leave it blank. If blank, a default image will be used.
                </p>
                @error('img')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex gap-4 mt-7 justify-end">
                <a href="{{ route('products.index') }}"
                   class="px-6 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-semibold rounded-xl transition shadow">
                    Cancel
                </a>
                <button type="submit"
                        class="px-8 py-2 bg-gradient-to-r from-blue-500 via-emerald-500 to-blue-600 hover:from-emerald-600 hover:to-blue-700 text-white font-bold rounded-xl shadow transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
