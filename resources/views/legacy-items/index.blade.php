<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Legacy Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Vault Items</h3>
                    <a href="{{ route('vault.show', $vault) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        + New Item
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach ($vault->legacyItems as $item)
                        <x-legacy-item-card :item="$item" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
