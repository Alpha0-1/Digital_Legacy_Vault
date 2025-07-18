<x-authentication-card>
    <x-slot name="logo">
        <x-authentication-card-logo />
    </x-slot>

    <x-validation-errors class="mb-4" />

    <h1 class="text-lg font-medium text-center mb-6">Two-Factor Authentication</h1>

    <form method="POST" action="{{ route('two-factor.login') }}" class="mt-6 space-y-6">
        @csrf

        <!-- Recovery Code -->
        <div>
            <x-label for="recovery_code" value="Recovery Code" />
            <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" autofocus />
            <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('logout') }}" class="text-sm text-gray-600 hover:text-gray-900">
                {{ __('Cancel') }}
            </a>

            <x-button class="ml-4">
                {{ __('Login') }}
            </x-button>
        </div>
    </form>
</x-authentication-card>
