@extends('admin.layouts.app')

@section('title', 'System Settings')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">System Settings</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('admin.system.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block mb-2 font-medium">Max Vault Size (MB)</label>
                    <input type="number" name="max_vault_size" 
                           value="{{ config('legacy-vault.data_retention.max_vault_size_mb') }}"
                           class="w-1/4 p-2 border rounded" required>
                </div>
                
                <div>
                    <label class="block mb-2 font-medium">Encryption Method</label>
                    <select name="encryption_method" class="w-1/4 p-2 border rounded">
                        <option value="AES-256-CBC" @if(config('legacy-vault.security.encryption_method') === 'AES-256-CBC') selected @endif>AES-256-CBC</option>
                        <option value="AES-128-CBC" @if(config('legacy-vault.security.encryption_method') === 'AES-128-CBC') selected @endif>AES-128-CBC</option>
                    </select>
                </div>
                
                <div>
                    <label class="block mb-2 font-medium">Inactivity Threshold (days)</label>
                    <input type="number" name="inactivity_threshold"
                           value="{{ config('legacy-vault.inactivity.monitoring.minimum_threshold_days') }}"
                           class="w-1/4 p-2 border rounded" required>
                </div>
                
                <div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
