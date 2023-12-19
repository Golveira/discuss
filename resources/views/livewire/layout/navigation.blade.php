<nav
    class="fixed left-0 right-0 top-0 z-40 border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center justify-between">
            {{-- Logo --}}
            <x-logo href="/" />

            <div class="flex items-center lg:order-2">
                {{-- Dark mode button --}}
                <div class="me-3">
                    <x-dark-mode />
                </div>

                @guest
                    <div class="flex gap-4">
                        {{-- Login --}}
                        <x-links.nav-link href="{{ route('login') }}" wire:navigate>
                            {{ __('Log In') }}
                        </x-links.nav-link>

                        {{-- Sign Up --}}
                        <x-links.nav-link class="hidden lg:block" href="{{ route('register') }}" wire:navigate>
                            {{ __('Sign Up') }}
                        </x-links.nav-link>
                    </div>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="mx-3 flex rounded-full text-sm focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 md:mr-0">
                                <x-icons.user-circle class="h-8 w-8" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Settings --}}
                            <x-dropdown-button :href="route('settings')" wire:navigate>
                                {{ __('Settings') }}
                            </x-dropdown-button>

                            {{-- Logout --}}
                            <x-dropdown-button wire:click="logout">
                                {{ __('Logut') }}
                            </x-dropdown-button>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>