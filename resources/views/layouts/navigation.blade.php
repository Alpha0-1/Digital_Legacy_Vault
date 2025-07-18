<nav class="bg-white border-b border-gray-100 fixed w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
            </div>

            <div class="flex items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 0 0-1.414 1.414L10 15l6.176-6.176a1 1 0 0 0-1.414-1.414L10 14.586">
                    </svg>
                </div>
            </x-dropdown>
            @endauth
        </div>
    </div>
</nav>
