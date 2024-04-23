<nav class="bg-gray-200 p-4 flex justify-between items-center">
    <!-- Navigation Links -->
    <div class="flex items-center space-x-4">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="text-gray-700 hover:text-gray-900">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <!-- Settings Dropdown -->
    <div class="relative">
        <x-dropdown>
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:bg-gray-100 focus:outline-none focus:bg-gray-100 active:bg-gray-100 transition ease-in-out duration-150">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-500">
                    {{ __('Manage Account') }}
                </div>

                <x-dropdown-link href="{{ route('profile.show') }}" class="text-gray-700 hover:bg-gray-50">
                    {{ __('Profile') }}
                </x-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index') }}" class="text-gray-700 hover:bg-gray-50">
                        {{ __('API Tokens') }}
                    </x-dropdown-link>
                @endif

                <div class="border-t border-gray-300 my-2"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();" class="text-gray-700 hover:bg-gray-50">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
