@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-12 bg-white/90 dark:bg-gray-900/90 shadow-2xl p-8 border border-emerald-100 dark:border-gray-800 backdrop-blur-md" style="border-radius:0;">
        <h2 class="text-2xl font-extrabold text-emerald-700 dark:text-emerald-200 mb-7 flex items-center gap-2" style="border-radius:0;">
            Edit Profile
        </h2>

        {{-- Success Message --}}
        @if (session('status') === 'profile-updated')
            <div class="mb-5 p-3 bg-green-100 border border-green-200 text-green-800 shadow-sm text-center" style="border-radius:0;">
                Profile updated successfully.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-7" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- صورة البروفايل مع زر الكاميرا --}}
            <div class="mb-4 flex flex-col items-center gap-2 relative group">
                <div class="relative w-32 h-32">
                    <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=34d399&color=fff&rounded=false' }}"
                         alt="Profile Image"
                         class="w-32 h-32 object-cover border border-emerald-200 dark:border-emerald-800"
                         style="border-radius:0;">
                    <!-- زر الكاميرا (أيقونة صورة) -->
                    <button type="button" onclick="document.getElementById('avatar-input').click();"
                            class="absolute bottom-2 right-2 bg-green-500 hover:bg-emerald-700 text-white shadow p-2 flex items-center justify-center"
                            style="border-radius: 100%; width: 40px; height: 40px;">
                        <!-- أيقونة كاميرا SVG -->
                        <span class="material-symbols-outlined">add_a_photo</span>
                    </button>
                    <!-- input مخفي -->
                    <input id="avatar-input" type="file" name="avatar" accept="image/*" class="hidden"
                           onchange="document.getElementById('avatar-file-name').textContent = this.files[0]?.name || '';">
                </div>
                <span id="avatar-file-name" class="text-xs text-gray-600 dark:text-gray-400"></span>
                @error('avatar')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-emerald-700 dark:text-emerald-200 mb-1">
                    Full Name
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 transition shadow-sm"
                       required style="border-radius:0;">
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
                       class="w-full border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 transition shadow-sm"
                       required style="border-radius:0;">
                @error('email')
                <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>

            {{-- Save Button --}}
            <div class="flex justify-end">
                <button type="submit"
                        class="px-7 py-2 bg-green-400 text-black px-8 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400"
                        style="border-radius:0;">
                    Save Changes
                </button>
            </div>
        </form>

        {{-- Delete Account --}}
        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4" style="border-radius:0;">
                <label for="password" class="block text-sm text-gray-700 dark:text-gray-300 mb-2">
                    Enter your password to confirm
                </label>
                <input type="password" name="password" id="password"
                       class="w-full border border-blue-100 dark:border-blue-800 bg-gray-50 dark:bg-gray-900/80 dark:text-gray-100 px-4 py-2 focus:ring-2 focus:ring-red-400 focus:border-red-500 transition shadow-sm"
                       required style="border-radius:0;">

                @error('password', 'userDeletion')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 flex justify-end" style="border-radius:0;">
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')"
                            class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold shadow transition"
                            style="border-radius:0;">
                        Delete Account Permanently
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
