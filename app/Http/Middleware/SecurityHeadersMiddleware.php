<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Content Security Policy
        $csp = config('security-headers.csp', []);
        $cspHeader = "Content-Security-Policy: ";
        foreach ($csp as $directive => $value) {
            $cspHeader .= "$directive $value; ";
        }
        
        $response->headers->set('Content-Security-Policy', $cspHeader);
        $response->headers->set('Strict-Transport-Security', config('security-headers.hsts'));
        $response->headers->set('X-Content-Type-Options', config('security-headers.x-content-type-options'));
        $response->headers->set('X-Frame-Options', config('security-headers.x-frame-options'));
        $response->headers->set('X-XSS-Protection', config('security-headers.x-xss-protection'));
        
        return $response;
    }
}
