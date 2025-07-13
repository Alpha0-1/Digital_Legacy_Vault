<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Vault;
use Symfony\Component\HttpFoundation\Response;

class VaultOwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $vaultId = $request->route('vault');
        $vault = Vault::find($vaultId);
        
        if (!$vault || $vault->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return $next($request);
    }
}
