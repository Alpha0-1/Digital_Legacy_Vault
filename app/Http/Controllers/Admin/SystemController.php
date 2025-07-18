<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function settings()
    {
        $this->authorize('manage', 'system');
        
        return view('admin.system.settings', [
            'inactivityThreshold' => config('inactivity.monitoring.minimum_threshold_days'),
            'maxVaultSize' => config('legacy-vault.data_retention.max_vault_size_mb')
        ]);
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'max_vault_size' => 'required|numeric|min:1',
            'encryption_method' => 'required|in:AES-256-CBC,AES-128-CBC',
            'inactivity_threshold' => 'required|numeric|min:7'
        ]);

        // Save system settings (would typically use a settings repository)
        config(['legacy-vault.data_retention.max_vault_size_mb' => $validated['max_vault_size']]);
        config(['legacy-vault.security.encryption_method' => $validated['encryption_method']]);
        config(['legacy-vault.inactivity.monitoring.minimum_threshold_days' => $validated['inactivity_threshold']]);

        return back()->with('success', 'System settings updated successfully');
    }
}
