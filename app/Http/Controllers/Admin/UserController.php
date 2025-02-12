<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Promote a user to admin
    public function promote(User $user)
{
    $user->role = 'admin';
    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'User promoted to admin successfully.');
}


    // Demote a user to regular user
    public function demote(User $user)
    {   
        if ($user->isUser()) {
            return redirect()->route('admin.users.index')->with('error', 'User is already a regular user.');
        }
        else {
            $user->update(['role' => 'user']);
            return redirect()->route('admin.users.index')->with('success', 'User demoted to regular user successfully.');
        }
    }

    public function create()
    {
        return view('admin.users.create');
    }

      // Store the new user in the database
      public function store(Request $request)
      {
          // Validate the input
          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email',
              'password' => 'required|string|min:8|confirmed',
              'role' => 'required|in:user,admin',
              'bio' => 'nullable|string|max:1000',
              'birthday' => 'nullable|date',
              'profile_photo' => 'nullable|image|max:2048',
          ]);
      
          // Handle profile photo upload
          $profilePhotoPath = null;
          if ($request->hasFile('profile_photo')) {
              $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
          }
      
          // Create the user
          User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password), // Hash the password
              'role' => $request->role,
              'bio' => $request->bio, // Store bio
              'birthday' => $request->birthday, // Store birthday
              'profile_photo' => $profilePhotoPath, // Store profile photo path
          ]);
      
          return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
      }
      
      public function update(Request $request, User $user)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|unique:users,email,' . $user->id,
              'bio' => 'nullable|string|max:1000',
              'birthday' => 'nullable|date',
              'role' => 'required|in:user,admin',
              'profile_photo' => 'nullable|image|max:2048',
          ]);
      
          // Handle profile photo upload
          if ($request->hasFile('profile_photo')) {
              $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
              $user->profile_photo = $photoPath;
          }
      
          // Update user details
          $user->update($request->only(['name', 'email', 'bio', 'birthday', 'role']));
      
          return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
      }
      

//edit user
public function edit(User $user)
{
    return view('admin.users.create', compact('user'));

}


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

}
