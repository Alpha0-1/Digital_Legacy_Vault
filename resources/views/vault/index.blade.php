<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vaults') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Your Vaults</h3>
                    <a href="{{ route('vault.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        + New Vault
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($vaults as $vault)
                        <x-vault-card :vault="$vault" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
