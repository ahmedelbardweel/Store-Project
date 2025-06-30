<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <title>Admin Panel | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-tr from-emerald-50 via-white to-emerald-100 dark:from-gray-900 dark:to-gray-800 min-h-screen font-Cairo">

<!-- Responsive Navbar -->
<nav class="fixed top-0 left-0 px-20 w-full z-50 bg-white dark:bg-gray-900 shadow">
    <div class="container mx-auto flex justify-between items-center py-3">
        <!-- Brand -->
        <div class="flex items-center gap-3">
            <span class="text-2xl font-black text-emerald-700 dark:text-emerald-300 tracking-tight select-none">Admin Panel</span>
        </div>
        <!-- Hamburger (mobile) -->
        <div class="lg:hidden">
            <button id="navbar-toggle" class="text-emerald-700 dark:text-emerald-300 focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        <!-- Navbar Links -->
        <ul id="navbar-links"
            class="flex-col lg:flex-row flex lg:items-center gap-1 lg:gap-6 absolute lg:static left-0 right-0 top-16 bg-white dark:bg-gray-900 lg:bg-transparent lg:dark:bg-transparent shadow-lg lg:shadow-none border-b lg:border-0 border-gray-100 dark:border-gray-800 lg:flex hidden transition-all">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}"
                   class="block px-4 py-2 font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                    Products
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                   class="block px-4 py-2 font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                    Orders
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.index') }}"
                   class="block px-4 py-2 font-semibold transition {{ request()->routeIs('admin.reports.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                    Reports
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reviews.index') }}"
                   class="block px-4 py-2 font-semibold transition {{ request()->routeIs('admin.reviews.*') ? 'bg-blue-100 text-blue-500' : 'text-gray-700 dark:text-gray-100 hover:bg-emerald-100 dark:hover:bg-gray-800' }}">
                    Reviews
                </a>
            </li>
            <!-- Logout (mobile only) -->
            <li class="block lg:hidden border-t border-gray-100 dark:border-gray-800 mt-2">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="w-full px-4 py-2 mt-2 bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition text-left">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
        <!-- Logout (desktop only) -->
        <form method="POST" action="{{ route('logout') }}" class="ml-4 hidden lg:block">
            @csrf
            <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white font-semibold shadow hover:bg-red-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- Main Content -->
<main class=" px-2 sm:px-6 lg:px-12 mb-12 bg-white/90 dark:bg-gray-800/90 min-h-[70vh] mt-20 shadow">
    @yield('content')
</main>

<script>
    // Mobile Navbar toggle
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('navbar-toggle');
        const links = document.getElementById('navbar-links');
        toggle?.addEventListener('click', function() {
            links.classList.toggle('hidden');
        });
    });
</script>
@stack('scripts')
</body>
</html>
