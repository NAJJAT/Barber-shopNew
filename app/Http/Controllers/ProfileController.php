<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    // Show the edit profile form
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }
   


    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . auth()->id(),
        'bio' => 'nullable|string|max:1000',
        'birthday' => 'nullable|date',
        'profile_photo' => 'nullable|image|max:2048', // Validate image file
    ]);

    $user = auth()->user();

    // Handle profile photo upload
    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo) {
            \Storage::delete('public/' . $user->profile_photo); // Delete old photo
        }
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $user->profile_photo = $path;
    }

    $user->update($request->only('name', 'email', 'bio', 'birthday'));

    return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
}

}
