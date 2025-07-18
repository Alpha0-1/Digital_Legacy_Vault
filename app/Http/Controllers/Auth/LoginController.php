<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $user = Auth::user();
        if ($user->requires2FA()) {
            return redirect()->route('two-factor.login');
        }

        $request->session()->regenerate();
        $user->updateLastActivity();

        return redirect()->intended('/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
