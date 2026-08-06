<?php

namespace App\Http\Controllers\apps;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserList extends Controller
{
  public function index()
  {
    return view('content.apps.app-user-list');
  }

  public function get_users()
  {
    $users = User::select('id', 'name', 'l_name', 'email', 'phone_number', 'image_path', 'created_at')
      ->get()
      ->map(function ($user) {
        return [
          'id' => $user->id,
          'full_name' => $user->name . ' ' . $user->l_name,
          'email' => $user->email,
          'phone' => $user->phone_number,
          'image_path' => $user->image_path,
          'created_at' => $user->created_at->format('Y-m-d'),
        ];
      });

    return response()->json(['data' => $users]);
  }

  public function create_user(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'l_name' => 'nullable|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone_number' => 'nullable|string|max:20',
      'password' => 'required|string|min:8',
      'image' => 'nullable|image|max:2048',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->l_name = $request->l_name;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;
    $user->password = Hash::make($request->password);

    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('profile_images', 'public');
      $user->image_path = 'storage/' . $imagePath;
    }

    $user->save();

    return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
  }
}
