<div x-data="{ openMenu: false }"
     class="relative rounded-2xl bg-white/90 dark:bg-gray-800/90 shadow-lg hover:shadow-2xl p-4 flex flex-col group transition-all duration-200 border border-gray-100 dark:border-gray-700"
     @click="if (!openMenu) window.location.href='{{ route('products.show', $product->id) }}'">

    {{-- صورة المنتج أو بديل --}}
    <div class="relative mb-3">
        @if($product->img)
            <img src="{{ $product->img }}"
                 alt="{{ $product->name }}"
                 class="h-44 w-full object-cover rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105 duration-300">
        @else
            <div class="h-44 w-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-emerald-50 dark:from-gray-700 dark:to-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                <span class="text-gray-400 dark:text-gray-500 font-semibold">There is no photo</span>
            </div>
        @endif

        {{-- زر قائمة الإدارة يظهر فقط للإدمن --}}
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="absolute top-2 right-2 z-10">
                    <button
                        @click.stop="openMenu = !openMenu"
                        class="p-2 bg-white dark:bg-gray-800 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600 shadow transition"
                        title="إدارة المنتج">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M6 10a2 2 0 114 0 2 2 0 01-4 0zm5-2a2 2 0 100 4 2 2 0 000-4zm3 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </button>
                    <div
                        x-cloak
                        x-show="openMenu"
                        @click.away="openMenu = false"
                        class="mt-1 w-36 bg-white dark:bg-gray-700 rounded-xl shadow-xl absolute right-0 z-20 overflow-hidden transition-all"
                        x-transition.opacity.origin.top.right>
                        <a href="{{ route('products.edit', $product->id) }}"
                           @click.stop
                           class="block px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-gray-800 transition font-semibold">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    @click.stop="if (confirm('Are you sure you want to delete this product?')) $el.closest('form').submit()"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-gray-800 transition font-semibold">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
    </div>

    {{-- محتوى البطاقة --}}
    <div class="flex flex-col flex-1 justify-between">
        <div>
            <h3 class="text-lg font-bold mb-1 text-gray-800 dark:text-gray-100 truncate">{{ $product->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                {{ Str::limit($product->description, 70) }}
            </p>
        </div>
        <div class="flex flex-col gap-2 mt-2">
            <span class="block text-emerald-600 dark:text-emerald-300 text-lg font-semibold mb-1">Price : {{ $product->price }}$</span>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full px-5 py-2 bg-gradient-to-r from-blue-400 via-emerald-500 to-blue-600 hover:from-emerald-500 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg transition text-base">
                    Add to cart 🛒
                </button>
            </form>
        </div>
    </div>
</div>
