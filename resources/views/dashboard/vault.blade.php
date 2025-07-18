<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vault Overview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold">{{ $vault->title }}</h3>
                    <span class="px-2 py-1 bg-{{ $vault->security_level }}-100 text-{{ $vault->security_level }}-700 rounded-md">
                        {{ __('Security Level:') }} {{ $vault->security_level }}
                    </span>
                </div>

                <div class="mt-6">
                    <h4 class="font-semibold text-gray-700">Vault Items</h4>
                    <ul class="mt-4 space-y-2">
                        @foreach ($vault->legacyItems as $item)
                            <li class="bg-gray-50 p-3 rounded-md">
                                {{ $item->title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
