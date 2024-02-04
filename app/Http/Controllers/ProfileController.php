<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if($request->user()->name == env('ADMIN_USERNAME', 'Admin'))
        {
            $user = env('ADMIN_USERNAME', 'Admin');
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        if(isset($user)) {
            $request->user()->name = $user;
        }

        if($request->has('avatar')){
            $request->validate([
               'avatar' => 'image'
            ]);
            $request->file('avatar')->storeAs('avatars', $request->user()->name, 'public');
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        if (Storage::disk('public')->exists('avatars/' . $request->user()->name)) {
            Storage::disk('public')->delete('avatars/' . $request->user()->name);
        }

        $user = $request->user();

        Auth::logout();

        //DELETE FROM users
        //WHERE name = $user->name;
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
