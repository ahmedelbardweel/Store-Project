<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store - لوحة المتجر</title>
    <!-- Google Fonts: Cairo & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Inter:wght@400;700&display=swap"
          rel="stylesheet">
    <!-- TailwindCSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html {
            font-family: 'Cairo', 'Inter', sans-serif;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            background: #f2f6fa;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #38bdf8;
            border-radius: 4px;
        }

        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #0ea5e9;
        }
    </style>
</head>
<body class="bg-gradient-to-tr from-blue-50 via-white to-emerald-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">

<!-- Navigation Bar (Fixed) -->
<nav
    class="fixed top-0 left-0 w-full pt-1 pb-1 z-40 bg-white dark:bg-gray-900/95 shadow-sm backdrop-blur border-b border-gray-100 dark:border-gray-800">
    <div class="flex items-center justify-between h-12 px-8">
        <!-- Logo & Brand -->
        <div class="flex items-center gap-4 flex-shrink-0">
            <span
                class="text-xl font-extrabold text-emerald-600 dark:text-emerald-300 tracking-tight select-none mr-20">
                AHMED
            </span>
        </div>

        <!-- Center: Search bar (Desktop) -->
        <div
            class="relative hidden md:block w-[320px] border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-base">
            <form method="GET" action="{{ route('products.index') }}" class="flex items-center w-full">
                <input
                    id="product-search"
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Searching..."
                    autocomplete="off"
                    class="flex h-10 px-5"
                >
                <button type="submit"
                        class="h-10 px-4 flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-black rounded-xl font-semibold">
                    <span class="material-symbols-outlined" style="color: #a3a3a3;" >search</span>
                </button>
            </form>
            <ul id="suggestions"
                class="absolute z-50 left-0 right-0 mt-1 bg-white dark:bg-gray-900 rounded-xl shadow border border-gray-200 dark:border-gray-700 hidden max-h-72 overflow-auto"></ul>
        </div>

        <!-- Right: Icons nav + user -->
        <div class="flex items-center gap-2">
            @auth
                <ul class="flex">
                    <!-- الرئيسية -->
                    <li>
                        <a href="{{ route('home') }}"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="الرئيسية">
                                <span class="material-symbols-outlined  " style="color: #5e5e5e;" >
                                home
                                </span>
                        </a>
                    </li>
                    <!-- المنتجات -->
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="المنتجات">
                            <span class="material-symbols-outlined" style="color: #5e5e5e;">shopping_bag</span>
                        </a>
                    </li>
                    <!-- السلة -->
                    <li>
                        <a href="{{ route('cart.index') }}"
                           style="color: #5e5e5e;"
                           class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                           title="السلة">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                        </a>
                    </li>
                    <!-- إضافة منتج جديد (أدمن فقط) -->
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('products.create') }}"
                               style="color: #5e5e5e;"
                               class="flex items-center justify-center w-8 h-8 rounded-xl transition text-gray-700 dark:text-gray-200 hover:bg-blue-50 dark:hover:bg-gray-800"
                               title="إضافة منتج جديد">
                                <span class="material-symbols-outlined">add_circle</span>
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 w-11 h-11">
                        <img
                            src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=38bdf8&color=fff&rounded=true' }}"
                            alt="User Avatar"
                            class="h-9 w-9 rounded-full object-cover"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 dark:text-gray-300"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div
                        x-show="open"
                        x-cloak
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-900 rounded-xl shadow-lg z-50 py-4 px-4 text-center transition border border-gray-100 dark:border-gray-700"
                        x-transition
                    >
                        <div class="mb-3">
                            <span
                                class="block font-bold text-lg text-emerald-700 dark:text-emerald-300">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-xs text-gray-500 dark:text-gray-400 mb-2">{{ Auth::user()->email }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                           class="block w-full py-2 my-2 rounded-lg bg-blue-50 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-700 text-blue-700 dark:text-blue-300 font-semibold transition">
                            الملف الشخصي
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full py-2 mt-2 rounded-lg bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition">
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-5 py-2 rounded-xl bg-blue-500 hover:bg-blue-700 text-white font-semibold shadow transition">
                    تسجيل الدخول
                </a>
            @endauth
        </div>
    </div>

    <!-- بحث للموبايل فقط -->
    <div class="relative md:hidden w-full px-4 pb-3 pt-2 bg-white dark:bg-gray-900">
        <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2 w-full">
            <input
                id="product-search-mobile"
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="ابحث عن منتج أو نوع المنتج..."
                autocomplete="off"
                class="flex-1 h-11 px-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-base w-full"
            >
            <button type="submit"
                    class="h-11 px-4 flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow transition">
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
<div class="min-h-[calc(100vh-64px)] p-8 custom-scrollbar mt-10">
    @yield('content')
</div>
@stack('scripts')

<!-- سكريبت البحث الذكي للمنتجات -->
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
                        list += '<li class="px-4 py-2 cursor-pointer hover:bg-blue-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200" onclick="selectSuggestion(\'' + inputId + '\', \'' + suggestionsId + '\', \'' + item.replace(/'/g, "\\'") + '\')">' + item + '</li>';
                    });
                } else {
                    list = '<li class="px-4 py-2 text-gray-400">لا يوجد نتائج</li>';
                }
                $('#' + suggestionsId).html(list).show();
            });
        });
    }

    function selectSuggestion(inputId, suggestionsId, val) {
        $('#' + inputId).val(val);
        $('#' + suggestionsId).hide().empty();
        // يمكنك عمل submit للفورم تلقائيًا إذا أردت:
        // $('#' + inputId).closest('form').submit();
    }

    $(function () {
        setupAutocomplete('product-search', 'suggestions');
        setupAutocomplete('product-search-mobile', 'suggestions-mobile');
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#product-search, #suggestions, #product-search-mobile, #suggestions-mobile').length) {
                $('#suggestions, #suggestions-mobile').hide();
            }
        });
    });
</script>

</body>
</html>
