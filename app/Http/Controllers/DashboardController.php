<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vault;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $vaults = $request->user()->vaults()
            ->with(['beneficiaries', 'legacyItems'])
            ->paginate(5);

        $inactivityThreshold = $request->user()->inactivitySettings->threshold_days;

        return view('dashboard.index', compact('vaults', 'inactivityThreshold'));
    }
}
