<!DOCTYPE html>
<html lang="ar" class="dark">
<head>
    <meta charset="utf-8">
    <title>لوحة تحكم الأدمن | @yield('title', 'لوحة التحكم')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Material Icons (اختياري) -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-tr from-emerald-50 via-white to-emerald-100 dark:from-gray-900 dark:to-gray-800 min-h-screen font-Cairo">

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 bg-white dark:bg-gray-900 shadow">
    <div class="container mx-auto flex justify-between items-center py-3 px-6">
    <!-- Logo -->
    <div class="flex items-center gap-3">
        <span class="text-2xl font-black text-emerald-700 dark:text-emerald-300 tracking-tight select-none">Admin Panel</span>
    </div>

    <!-- Links -->
    <ul class="flex items-center gap-2 md:gap-6">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                لوحة التحكم
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}"
               class="px-4 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                المنتجات
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}"
               class="px-4 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                الطلبات
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reports.index') }}"
               class="px-4 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.reports.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                الإحصائيات
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reviews.index') }}"
               class="px-4 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.reviews.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                التقييمات
            </a>
        </li>
    </ul>


    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="ml-4">
        @csrf
        <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-xl font-semibold shadow hover:bg-red-400 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            تسجيل الخروج
        </button>
    </form>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-7xl mx-auto mb-12 p-8 bg-white/90 dark:bg-gray-800/90  min-h-[70vh] mt-20 px-4">
    @yield('content')
</main>

@stack('scripts')
</body>
</html>
