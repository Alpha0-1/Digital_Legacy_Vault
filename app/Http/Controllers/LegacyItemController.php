<?php

namespace App\Http\Controllers;

use App\Http\Requests\LegacyItem\CreateLegacyItemRequest;
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

    public function store(CreateLegacyItemRequest $request)
    {
        $vault = $request->user()->vaults()->findOrFail($request->vault_id);

        if (!Crypt::verifyKey($request->encryption_key, $vault->encryption_key_hash)) {
            return back()->withErrors(['encryption_key' => 'Invalid encryption key']);
        }

        $vault->legacyItems()->create([
            'title' => $request->title,
            'content' => Crypt::encrypt($request->content, $request->encryption_key),
            'type' => $request->type,
        ]);

        return back()->with('status', 'Legacy item created');
    }
}
