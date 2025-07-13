<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vault;
use App\Services\EncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaultController extends Controller
{
    protected $encryptionService;

    public function __construct(EncryptionService $encryptionService)
    {
        $this->middleware('auth:sanctum');
        $this->middleware('vault.owner');
        $this->encryptionService = $encryptionService;
    }

    // Get vault data
    public function show(Request $request)
    {
        $vault = Auth::user()->vault;
        
        if (!$vault) {
            return response()->json(['error' => 'Vault not found'], 404);
        }

        try {
            $decryptedContent = $this->encryptionService->decrypt(
                $vault->content, 
                $request->input('encryption_key')
            );
            
            return response()->json([
                'vault' => $vault,
                'content' => $decryptedContent
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid encryption key'], 403);
        }
    }

    // Update vault content
    public function update(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'encryption_key' => 'required|string',
        ]);

        $user = Auth::user();
        $vault = $user->vault;

        try {
            $encryptedContent = $this->encryptionService->encrypt(
                $request->content, 
                $request->encryption_key
            );

            $vault->update([
                'content' => $encryptedContent,
                'security_level' => $request->input('security_level', 'high')
            ]);

            return response()->json(['message' => 'Vault updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Encryption failed'], 500);
        }
    }
}
