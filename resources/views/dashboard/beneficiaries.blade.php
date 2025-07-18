<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beneficiaries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">Beneficiaries</h3>
                    <a href="{{ route('beneficiaries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        + Add Beneficiary
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach ($beneficiaries as $beneficiary)
                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                            <div class="font-bold">{{ $beneficiary->name }}</div>
                            <div class="text-gray-600">{{ $beneficiary->email }}</div>
                            <div class="text-sm text-gray-500 mt-1">
                                {{ __('Relationship:') }} {{ $beneficiary->relationship }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
