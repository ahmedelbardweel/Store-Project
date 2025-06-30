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
            background: #f8fafc;
            min-height: 100vh;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

<div class="w-full max-w-md mx-auto my-10">
    <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 80)"
         x-show="show"
         x-transition:enter="transition-all duration-700 ease-out"
         x-transition:enter-start="opacity-0 scale-90 translate-y-8"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="bg-white dark:bg-gray-900/95 shadow-2xl p-8 border border-emerald-300 dark:border-emerald-900" style="border-radius:0">

        <div class="flex flex-col items-center mb-8">
            <h2 class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-300 mb-1 tracking-widest" style="letter-spacing: 2px;">Register a new account</h2>
            <p class="text-gray-500 dark:text-gray-300 text-xs text-center">Join now and enjoy a modern and easy shopping experience!</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-bold text-sm">Full name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-200 focus:border-emerald-400 transition shadow-sm"
                       style="border-radius:0;">
                @error('name')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-bold text-sm">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       style="border-radius:0;">
                @error('email')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-bold text-sm">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       style="border-radius:0;">
                @error('password')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block mb-1 text-emerald-700 dark:text-emerald-300 font-bold text-sm">Confirm password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/70 dark:text-gray-100 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       style="border-radius:0;">
                @error('password_confirmation')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-xs text-green-800 dark:text-blue-300 hover:underline font-semibold">Already have an account?</a>
            </div>

            <div class="flex items-center justify-between mt-7">
                <button type="submit"
                        class="block w-full py-2 bg-green-400 text-black px-8 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400"
                        style="border-radius:0;">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
