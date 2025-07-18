<aside class="w-64 bg-white shadow-md h-full">
    <nav class="mt-4">
        <h3 class="px-4 py-2 text-gray-500 uppercase text-xs">Vault</h3>
        <x-navigation :active="request()->routeIs('vault.index')" href="{{ route('vault.index') }}">
            Vaults
        </x-navigation>
        <x-navigation :active="request()->routeIs('vault.beneficiaries.index')" href="{{ route('vault.beneficiaries.index') }}">
            Beneficiaries
        </x-navigation>

        <h3 class="mt-8 px-4 py-2 text-gray-500 uppercase text-xs">Settings</h3>
        <x-navigation :active="request()->routeIs('profile.show')" href="{{ route('profile.show') }}">
            Profile
        </x-navigation>
        <x-navigation :active="request()->routeIs('inactivity.settings')" href="{{ route('inactivity.settings') }}">
            Inactivity Settings
        </x-navigation>
    </nav>
</aside>
