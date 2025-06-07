<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل حساب جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html { font-family: 'Cairo', sans-serif; }
        body {
            background-image: url('/images/shop-bg.png');
            background-repeat: repeat;
            background-size: 320px;
            background-position: center;
            background-color: #f6fbff;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

<div class="w-full max-w-md mx-auto my-8 bg-white">
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 80)"
         x-show="show"
         x-transition:enter="transition-all duration-700 ease-out"
         x-transition:enter-start="opacity-0 scale-90 translate-y-8"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="bg-white/90 dark:bg-gray-900/95 rounded-3xl shadow-2xl p-8 border border-emerald-100 dark:border-gray-800 backdrop-blur-md">

        <div class="flex flex-col items-center mb-8">
            <h2 class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-200 mb-2">Register a new account</h2>
            <p class="text-gray-500 dark:text-gray-300 text-sm text-center">Join now and enjoy a modern and easy shopping experience!</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-semibold">Full name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full rounded-xl border border-emerald-100 dark:border-emerald-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm">
                @error('name')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-semibold">e-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm">
                @error('email')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-semibold">password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm">
                @error('password')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-semibold">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm">
                @error('password_confirmation')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <a href="{{ route('login') }}" class="text-sm text-blue-600 dark:text-blue-300 hover:underline font-semibold mt-10">Already have an account?</a>

            <div class="flex items-center justify-between mt-7">
                <button type="submit"
                        class="block w-full py-2 my-2 rounded-lg bg-blue-50 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-blue-700 text-blue-700 dark:text-blue-300 font-semibold transition">
                    registration
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
