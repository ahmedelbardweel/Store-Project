@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-2xl font-semibold mb-4">My Profile</h2>

        <div class="flex items-center space-x-6">
            <img src="{{ $user->avatar_url ?? 'https://via.placeholder.com/150' }}"
                 alt="{{ $user->name }}"
                 class="w-32 h-32 rounded-full object-cover">
            <div>
                <p class="text-lg font-medium">{{ $user->name }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Role: {{ $user->role ?? '–' }}
                </p>
            </div>
        </div>
    </div>
@endsection
