@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-12 bg-white/90 dark:bg-gray-900/90 rounded-2xl shadow-2xl p-8 border border-emerald-100 dark:border-gray-800 backdrop-blur-md">
        <h2 class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-200 mb-7 flex items-center gap-2">
            Edit Profile
        </h2>

        {{-- Success Message --}}
        @if (session('status') === 'profile-updated')
            <div class="mb-5 p-3 bg-green-100 border border-green-200 text-green-800 rounded-lg shadow-sm text-center">
                Profile updated successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-7">
            @csrf
            @method('PATCH')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-emerald-700 dark:text-emerald-200 mb-1">
                    Full Name
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       required>
                @error('name')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold text-emerald-700 dark:text-emerald-200 mb-1">
                    Email Address
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       required>
                @error('email')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="px-7 py-2 rounded-xl bg-gradient-to-r from-blue-500 via-emerald-500 to-blue-600 hover:from-emerald-600 hover:to-blue-700 text-white text-lg font-bold shadow-lg transition-all duration-200">
                    Save Changes
                </button>
            </div>
        </form>

        {{-- Delete Account --}}
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <label for="password" class="block text-sm text-gray-700 dark:text-gray-300 mb-2">
                    Enter your password to confirm
                </label>
                <input type="password" name="password" id="password"
                       class="w-full rounded-xl border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition shadow-sm"
                       required>

                @error('password', 'userDeletion')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex justify-end">
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')"
                            class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold shadow transition">
                        Delete Account Permanently
                    </button>
                </div>
            </div>
        </form>

    </div>
@endsection
