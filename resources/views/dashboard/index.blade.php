<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-md border-l-4 border-blue-500">
                        <h3 class="text-blue-700 font-semibold">Vaults</h3>
                        <p class="text-3xl text-blue-900">{{ $vaults->count() }}</p>
                    </div>
                    
                    <div class="bg-green-50 p-4 rounded-md border-l-4 border-green-500">
                        <h3 class="text-green-700 font-semibold">Beneficiaries</h3>
                        <p class="text-3xl text-green-900">{{ $beneficiaries->count() }}</p>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-md border-l-4 border-yellow-500">
                        <h3 class="text-yellow-700 font-semibold">Last Active</h3>
                        <p class="text-3xl text-yellow-900">{{ $lastActive }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold mb-4">Recent Vaults</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($vaults as $vault)
                            <div class="vault-card">
                                <h3 class="text-lg font-bold">{{ $vault->title }}</h3>
                                <p class="text-sm text-gray-500">{{ $vault->description }}</p>
                                <a href="{{ route('vault.show', $vault) }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                                    View Vault
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
