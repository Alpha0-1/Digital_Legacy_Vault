<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LegacyRelease;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAdmin', $request->user());

        $inactivityAlerts = User::with('inactivitySettings')
            ->whereHas('inactivitySettings', function ($query) {
                $query->where('last_activity_at', '<', now()->subDays(83));
            })
            ->paginate(10);

        $recentReleases = LegacyRelease::with(['user', 'beneficiary'])
            ->where('status', 'released')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'inactivityAlerts',
            'recentReleases'
        ));
    }
}
