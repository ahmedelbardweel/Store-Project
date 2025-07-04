@extends('layouts.admin')
@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-black">All Products</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-300 px-5 py-2 rounded-none text-black font-bold shadow hover:bg-emerald-700 transition">
            + Add Product
        </a>
    </div>
    @if(session('success'))
        <div class="p-3 mb-4 bg-green-100 border border-green-300 text-green-800 rounded-none shadow">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
        @forelse($products as $p)
            <div class="bg-white dark:bg-gray-900 rounded-none shadow-lg p-5 flex flex-col items-center group hover:shadow-2xl transition border border-gray-200 dark:border-gray-700">
                <img src="{{ $p->img }}" alt="{{ $p->name }}"
                     class="w-full h-100 mb-4 group-hover:scale-105 transition duration-200 border border-gray-100 dark:border-gray-700">
                <div class="font-bold text-lg text-emerald-700 dark:text-emerald-200 mb-1">{{ $p->name }}</div>
                <div class="text-gray-700 dark:text-gray-300 text-base mb-3">{{ $p->price }} $</div>
                <div class="flex gap-3 w-full mt-auto">
                    <a href="{{ route('admin.products.edit', $p) }}"
                       class="flex-1 text-center py-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-none font-semibold hover:bg-blue-200 hover:text-blue-900 transition border border-blue-300 dark:border-blue-800">Edit</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full py-2 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 rounded-none font-semibold hover:bg-red-200 hover:text-red-900 transition border border-red-300 dark:border-red-800"
                                onclick="return confirm('Are you sure you want to delete this product?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-400 py-20">No products found.</div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
@endsection
