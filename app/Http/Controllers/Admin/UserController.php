<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('manage', 'users');
        return view('admin.users', ['users' => User::paginate(20)]);
    }

    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
