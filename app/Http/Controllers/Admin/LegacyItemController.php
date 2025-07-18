<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LegacyItem;
use Illuminate\Http\Request;

class LegacyItemController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()
            ->vaults()
            ->find($request->vault_id)
            ->legacyItems()
            ->paginate(10);

        return view('legacy-items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vault_id' => 'required|exists:vaults,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:document,message,account',
            'encryption_key' => 'required|min:32',
        ]);

        $vault = $request->user()->vaults()->findOrFail($request->vault_id);

        if (!\App\Services\EncryptionService::verifyKey($request->encryption_key, $vault->encryption_key_hash)) {
            return back()->withErrors(['encryption_key' => 'Invalid encryption key']);
        }

        $vault->legacyItems()->create([
            'title' => $request->title,
            'content' => \App\Services\EncryptionService::encrypt(
                $request->content,
                $request->encryption_key
            ),
            'type' => $request->type,
        ]);

        return back()->with('status', 'Legacy item created');
    }
}
