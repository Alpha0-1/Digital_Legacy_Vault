<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Legacy Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('vault.legacy-items.update', [$vault, $item]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$item->title" required />

                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="content" :value="__('Content')" />
                        <textarea id="content" name="content" class="block mt-1 w-full rounded-md border-gray-300">
                            {{ $item->content }}
                        </textarea>

                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-button class="ml-4">
                        {{ __('Update Item') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
