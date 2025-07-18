<?php

namespace App\Http\Controllers;

use App\Http\Requests\Beneficiary\CreateBeneficiaryRequest;
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

    public function store(CreateBeneficiaryRequest $request)
    {
        $beneficiary = $request->user()
            ->beneficiaries()
            ->create($request->validated());

        $this->dispatch(new BeneficiaryNotified($beneficiary, $request->vault_id));

        return back()->with('status', 'Beneficiary added successfully');
    }
}
