@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-[70vh] p-4">
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 100)"
            x-show="show"
            x-transition:enter="transition-all duration-700 ease-out"
            x-transition:enter-start="opacity-0 scale-95 translate-y-10 blur-sm"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0 blur-0"
            class="w-full max-w-lg bg-white/90 dark:bg-gray-900/90 backdrop-blur-lg border border-emerald-100 dark:border-gray-800 shadow-2xl rounded-3xl p-8"
        >
            <h2 class="text-2xl md:text-3xl font-extrabold text-emerald-700 dark:text-emerald-200 mb-6 flex items-center gap-2">
                Create a new product
            </h2>

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

            <form method="POST"
                  action="{{ route('products.store') }}"
                  class="space-y-6">
                @csrf

                {{-- اسم المنتج --}}
                <div>
                    <label for="name" class="block mb-1 text-base font-semibold text-emerald-700 dark:text-emerald-300">
                        Product name
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           required
                           class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-800 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 shadow px-4 py-2 focus:ring focus:ring-emerald-200 focus:border-emerald-400 transition">
                </div>

                {{-- وصف المنتج --}}
                <div>
                    <label for="description" class="block mb-1 text-base font-semibold text-emerald-700 dark:text-emerald-300">
                        Description
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-800 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 shadow px-4 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400 transition">{{ old('description') }}</textarea>
                </div>

                {{-- السّلغ --}}
                <div>
                    <label for="slug" class="block mb-1 text-base font-semibold text-emerald-700 dark:text-emerald-300">
                        Slug <span class="text-xs text-gray-500">(optional)</span>
                    </label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           value="{{ old('slug') }}"
                           class="mt-1 block w-full rounded-xl border border-emerald-100 dark:border-emerald-800 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 shadow px-4 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400 transition">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        You can leave it blank and it will be automatically created by name.
                    </p>
                </div>

                {{-- السعر --}}
                <div>
                    <label for="price" class="block mb-1 text-base font-semibold text-emerald-700 dark:text-emerald-300">
                        the price
                    </label>
                    <input type="number"
                           name="price"
                           id="price"
                           step="0.01"
                           value="{{ old('price') }}"
                           required
                           class="mt-1 block w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 shadow px-4 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400 transition">
                </div>

                {{-- رابط الصورة --}}
                <div>
                    <label for="img" class="block mb-1 text-base font-semibold text-emerald-700 dark:text-emerald-300">
                        Product Image Link (URL)
                    </label>
                    <input type="url"
                           name="img"
                           id="img"
                           placeholder="https://example.com/image.jpg"
                           value="{{ old('img') }}"
                           class="mt-1 block w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 shadow px-4 py-2 focus:ring focus:ring-emerald-100 focus:border-emerald-400 transition">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Enter a direct link to the product image from the Internet (optional).
                    </p>
                    @error('img')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- زرّ الحفظ --}}
                <div class="flex justify-end mt-8">
                    <button type="submit"
                            class="inline-block px-8 py-3 rounded-xl bg-blue-500 hover:bg-emerald-500 text-white text-lg font-bold shadow transition">
                        Save the product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
