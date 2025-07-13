<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Str;

class RateLimitMiddleware
{
    public function handle(Request $request, Closure $next, string $rateLimit): Response
    {
        $key = $rateLimit === 'api' 
            ? $request->user()?->id ?? $request->ip()
            : $request->ip();

        $limit = config("rate_limits.{$rateLimit}", 60);

        if (RateLimiter::tooManyAttempts($key, $limit)) {
            return response()->json([
                'error' => 'Too many requests',
                'retry_after' => RateLimiter::availableIn($key)
            ], 429);
        }

        RateLimiter::hit($key, $limit);
        
        return $next($request);
    }
}
