<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $beneficiaries = $request->user()
            ->beneficiaries()
            ->with('vault')
            ->paginate(10);

        return view('beneficiaries.index', compact('beneficiaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:beneficiaries,email,NULL,id,vault_id,'.$request->vault_id,
            'vault_id' => 'required|exists:vaults,id',
            'access_level' => 'required|in:view,edit,admin',
        ]);

        $request->user()->beneficiaries()->create($request->all());

        return back()->with('status', 'Beneficiary added');
    }
}
