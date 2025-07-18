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
                    <h3 class="text-lg font-semibold">Your Beneficiaries</h3>
                    <a href="{{ route('beneficiaries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        + Add Beneficiary
                    </a>
                </div>

                <div class="space-y-4">
                    @foreach ($beneficiaries as $beneficiary)
                        <div class="beneficiary-card bg-gray-50 p-4 rounded-md border border-gray-200">
                            <h4 class="font-bold">{{ $beneficiary->name }}</h4>
                            <p class="text-gray-600">{{ $beneficiary->email }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                {{ __('Access level:') }} {{ $beneficiary->pivot->access_level }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
