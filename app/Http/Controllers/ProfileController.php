<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('user.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // تحديث بيانات الحساب + رفع صورة بروفايل
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // تحقق من الصورة
        ]);

        $user = $request->user();

        // تحديث البيانات الأساسية
        $user->fill($request->only(['name', 'email']));

        // لو تم رفع صورة جديدة
        if ($request->hasFile('avatar')) {
            $avatar      = $request->file('avatar');
            $avatarName  = 'avatar_' . $user->id . '_' . time() . '.' . $avatar->extension();
            $avatar->move(public_path('uploads/avatars'), $avatarName);
            $user->avatar_url = '/uploads/avatars/' . $avatarName;
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // مسح الحساب للمستخدم
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // صفحة عرض البروفايل مع الطلبات
    public function show()
    {
        $user   = auth()->user();
        $orders = $user->orders()->with('orderItems.product')->latest()->get();
        return view('user.profile.show', compact('user', 'orders'));
    }
}
