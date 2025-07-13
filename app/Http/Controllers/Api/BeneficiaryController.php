<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        return Beneficiary::where('user_id', $request->user()->id)
            ->with(['legacyItems'])
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'relationship' => 'required|string|max:255'
        ]);

        $beneficiary = Beneficiary::create(array_merge(
            $validated,
            ['user_id' => $request->user()->id]
        ));

        return response()->json($beneficiary, 201);
    }
}
