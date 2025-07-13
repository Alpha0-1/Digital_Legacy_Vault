<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorAuthentication
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session('2fa_verified_at') && now()->diffInMinutes(session('2fa_verified_at')) < 30) {
            return $next($request);
        }

        session(['2fa_intended_url' => $request->url()]);
        return redirect()->route('two-factor.verify');
    }
}
