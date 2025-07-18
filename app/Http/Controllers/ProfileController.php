
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'user' => $request->user(),
            'inactivitySettings' => $request->user()->inactivitySettings,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$request->user()->id,
            'password' => 'nullable|min:12|confirmed',
        ]);

        $user = $request->user();
        $user->update($request->only('name', 'email'));

        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return back()->with('status', 'Profile updated');
    }
}
