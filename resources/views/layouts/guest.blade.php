<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-green-100 to-white">

<div class="min-h-screen flex flex-col items-center justify-center">
    <div>
        <a href="/">
            <x-application-logo class="w-24 h-24 text-green-600" />
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-8 px-6 py-8 bg-white border border-green-200 shadow-lg rounded-xl">
        <h2 class="text-center text-2xl font-semibold text-green-700 mb-6">
            {{ __('Welcome!') }}
        </h2>

        {{ $slot }}
    </div>

    <div class="mt-8 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name') }}All rights reserved.
    </div>
</div>

</body>
</html>
