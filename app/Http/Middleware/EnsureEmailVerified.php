<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if ($user && !$user->hasVerifiedEmail()) {
            return response()->json([
                'error' => 'Email not verified',
                'needs_verification' => true
            ], 403);
        }
        
        return $next($request);
    }
}
