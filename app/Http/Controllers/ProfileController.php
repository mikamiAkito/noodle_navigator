<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\ImageUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = Auth::user();
        $profilePhotoUrl = $user->profile_photo ? Storage::url($user->profile_photo) : "";
        $coverPhotoUrl = $user->cover_photo ? Storage::url($user->cover_photo) : "";
// dd($profilePhotoUrl);
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'profilePhotoUrl' => $profilePhotoUrl,
            'coverPhotoUrl' => $coverPhotoUrl,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/noodle-nav');
    }

    //プロフィール画像アップデート処理
    public function image(ImageUpdateRequest $request): RedirectResponse
    {
        // dd($request);
        $user = $request->user();

        // プロフィール画像のアップデート
        if ($request->hasFile('profile_photo')) {
            // dd($request);
            // 古い画像を削除
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // 新しい画像をアップロードして保存
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $profilePhotoPath;
        }

        // 背景画像のアップデート
        if ($request->hasFile('cover_photo')) {
            // dd($request);
            // 古い画像を削除
            if ($user->cover_photo) {
                Storage::disk('public')->delete($user->cover_photo);
            }

            // 新しい画像をアップロードして保存
            $coverPhotoPath = $request->file('cover_photo')->store('cover_photos', 'public');
            $user->cover_photo = $coverPhotoPath;
        }

        $user->save();

        return Redirect::route('profile.edit');
    }

}