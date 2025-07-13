<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function showVerificationNotice()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'hash' => 'required'
        ]);

        $user = User::find($request->id);

        if (!$user || !hash_equals((string) $user->getKey(), (string) $request->id)) {
            return response()->json(['error' => 'Invalid verification link'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $user->markEmailAsVerified();
        
        return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
    }

    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('success', 'Verification link sent!');
    }
}
