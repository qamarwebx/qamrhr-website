<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\auth\LoginRequest;

class LoginBasic extends Controller
{

  // show form
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function login(LoginRequest $request): RedirectResponse
  {
    $request->authenticate();

    $request->session()->regenerate();
    return redirect('/');
  }

  public function update(Request $request, User $user)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    $user->update($validated);

    return response()->json(['success' => true, 'user' => $user]);
  }

  public function change_password(Request $request, User $user)
  {
    $validated = $request->validate([
      'current_password' => 'required',
      'new_password' => 'required|string|min:8|confirmed',
    ]);

    if (!Hash::check($validated['current_password'], $user->password)) {
      return response()->json(['success' => false, 'message' => 'Current password is incorrect'], 400);
    }

    $user->update(['password' => Hash::make($validated['new_password'])]);

    return response()->json(['success' => true]);
  }

  public function destroy(User $user)
  {
    $user->delete();
    return response()->json(['success' => true]);
  }
}
