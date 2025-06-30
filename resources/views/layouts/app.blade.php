<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store</title>
    <!-- Google Fonts: Cairo & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Inter:wght@400;700&display=swap"
          rel="stylesheet">
    <!-- TailwindCSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html { font-family: 'Cairo', 'Inter', sans-serif; }
        body { background-color: rgb(255, 255, 255); }
        li { list-style: none; }
    </style>
</head>
<body class="from-blue-50 via-white to-emerald-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">

<!-- Navigation Bar (Fixed) -->
<nav class="fixed top-0 left-0 w-full z-40 bg-white dark:bg-gray-900/95 shadow-sm backdrop-blur border-b border-gray-100 dark:border-gray-800">
    <div class="flex items-center justify-between h-13 px-8 py-2">
        <!-- Logo & Brand -->
        <div class="flex items-center gap-4 flex-shrink-0">
            <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-300 tracking-tight select-none mr-40">
                NIKE
            </span>
        </div>

        <!-- Center: Search bar (Desktop) -->
        <div
            class=" relative hidden md:block ml-35 w-[500px] border border-green-400 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-base">
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center w-full m-0">
                <input
                    id="product-search"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search for products..."
                    autocomplete="off"
                    class="flex h-10 p-5"
                >
                <button type="submit"
                        class="h-10 px-4 flex items-center justify-center  bg-green-400 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400">
                    <span class="material-symbols-outlined">search</span>
                </button>
            </form>
            <ul id="suggestions"
                class="absolute z-50 left-0 right-0 mt-1 bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-700 hidden max-h-72 overflow-auto"></ul>
        </div>

        <!-- Right: Icons nav + user -->
        <div class="flex items-center gap-2">
            @auth
                <ul class="flex">
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex text-sm items-center font-bold justify-center p-2 transition text-black dark:text-gray-200 hover:bg-green-100 dark:hover:bg-gray-800"
                           title="Products">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.history') }}"
                           class="flex text-sm items-center font-bold justify-center p-2 transition text-black dark:text-gray-200 hover:bg-green-100 dark:hover:bg-gray-800">
                            Orders
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('cart.show') }}"
                           class="flex text-sm items-center font-bold justify-center p-2 transition text-black dark:text-gray-200 hover:bg-green-100 dark:hover:bg-gray-800">
                            Cart
                        </a>
                    </li>
                </ul>
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button >
                        <a href="{{ route('profile.show') }}" class="flex items-center gap-1 w-11 h-11">
                            <img
                                src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=34d399&color=fff&rounded=true' }}"
                                alt="User Avatar"
                                class="h-7 w-7 rounded-full object-cover"
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 dark:text-gray-300"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </a>
                    </button>
                    <div
                        x-show="open"
                        x-cloak
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-900  shadow-lg z-50 py-4 px-4 text-center transition border border-gray-100 dark:border-gray-700"
                        x-transition
                    >
                        <div class="mb-3">
                            <span class="block font-bold text-lg text-emerald-700 dark:text-emerald-300">{{ Auth::user()->name }}</span>
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mb-2">{{ Auth::user()->email }}</span>
                        </div>
                        <a href="{{ route('profile.show') }}"
                           class="block w-full py-2 my-2 bg-blue-50 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-700 text-blue-700 dark:text-blue-300 font-semibold transition">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full py-2 mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex gap-4">
                    <a href="{{ route('login') }}"
                       class="inline-block bg-green-400 text-black px-6 py-2 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400"
                       style="border-radius:0; width:fit-content;">
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Mobile search only -->
    <div class="relative md:hidden w-full px-4 pb-3 pt-2 bg-white dark:bg-gray-900">
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2 w-full">
            <input
                id="product-search-mobile"
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search for products or categories..."
                autocomplete="off"
                class="flex-1 h-11 px-4 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-base w-full"
            >
            <button type="submit"
                    class="h-10 px-4 flex items-center justify-center  bg-green-400 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <circle cx="11" cy="11" r="7" stroke-width="2"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2"/>
                </svg>
            </button>
        </form>
        <ul id="suggestions-mobile"
            class="absolute z-50 left-0 right-0 mt-1 bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-700 hidden max-h-72 overflow-auto"></ul>
    </div>
</nav>

<!-- Main Content -->
<div class="min-h-[calc(100vh-64px)] pb-10 custom-scrollbar mt-10 px-4">
    @yield('content')
</div>
@stack('scripts')

<!-- Product smart search script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function setupAutocomplete(inputId, suggestionsId) {
        $('#' + inputId).on('input', function () {
            let query = $(this).val();
            if (query.length < 1) {
                $('#' + suggestionsId).hide().empty();
                return;
            }
            $.get('{{ route("products.autocomplete") }}', {q: query}, function (data) {
                let list = '';
                if (data.length > 0) {
                    data.forEach(function (item) {
                        // لاحظ هنا، الكلام الذي كتبته يظهر ضمن النتائج
                        list += `<li class="px-4 py-2 cursor-pointer hover:bg-green-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200 border-b last:border-0">
                            <a href="${item.url}" class="block w-full truncate">${item.name}</a>
                        </li>`;
                    });
                } else {
                    list = '<li class="px-4 py-2 text-gray-400">No results found</li>';
                }
                $('#' + suggestionsId).html(list).show();
            });
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#'+inputId+', #'+suggestionsId).length) {
                $('#' + suggestionsId).hide();
            }
        });
    }

    $(function () {
        setupAutocomplete('product-search', 'suggestions');
        setupAutocomplete('product-search-mobile', 'suggestions-mobile');
    });
</script>
</body>
</html>
