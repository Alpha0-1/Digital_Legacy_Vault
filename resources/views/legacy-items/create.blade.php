<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Legacy Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('vault.legacy-items.store', $vault) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />

                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" class="block mt-1 w-full rounded-md border-gray-300"></textarea>

                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="security_level" :value="__('Security Level')" />
                        <select id="security_level" name="security_level" class="block mt-1 w-full rounded-md border-gray-300">
                            <option value="low">{{ __('Low') }}</option>
                            <option value="medium">{{ __('Medium') }}</option>
                            <option value="high">{{ __('High') }}</option>
                        </select>

                        @error('security_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="encryption_key" :value="__('Encryption Key')" />
                        <x-input id="encryption_key" class="block mt-1 w-full" type="text" name="encryption_key" required />

                        <p class="text-sm text-gray-500 mt-1">
                            {{ __('Keep this key secure. It cannot be recovered.') }}
                        </p>

                        @error('encryption_key')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-button class="ml-4">
                        {{ __('Create Item') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
