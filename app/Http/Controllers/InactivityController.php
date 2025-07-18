<?php

namespace App\Http\Controllers;

use App\Services\InactivityService;
use Illuminate\Http\Request;

class InactivityController extends Controller
{
    private $inactivityService;

    public function __construct(InactivityService $inactivityService)
    {
        $this->inactivityService = $inactivityService;
    }

    public function edit(Request $request)
    {
        return view('dashboard.inactivity-settings', [
            'settings' => $request->user()->inactivitySetting
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'inactivity_threshold_days' => 'required|integer|min:7|max:365',
            'notification_days_before' => 'required|array',
            'auto_release_enabled' => 'boolean'
        ]);

        $request->user()->inactivitySetting->update($validated);
        
        return back()->with('success', 'Inactivity settings updated successfully');
    }
}
