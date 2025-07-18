<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use Illuminate\Http\Request;

class VaultController extends Controller
{
    public function index(Request $request)
    {
        return view('vault.index', [
            'vault' => $request->user()->vault
        ]);
    }

    public function create()
    {
        return view('vault.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'security_level' => 'required|in:low,medium,high'
        ]);

        $vault = Vault::create(array_merge(
            $request->only(['title', 'description', 'security_level']),
            ['user_id' => $request->user()->id]
        ));

        return redirect()->route('vault.show', $vault);
    }
}
