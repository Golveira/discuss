<nav class="border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
    <div class="container mx-auto">
        <div class="flex flex-wrap items-center justify-between">
            {{-- Logo --}}
            <x-logo href="/" />

            <div class="flex items-center gap-2 lg:order-2">
                {{-- Dark mode --}}
                <x-dark-mode />

                @guest
                    {{-- Login --}}
                    <x-links.nav-link href="{{ route('login') }}" wire:navigate>
                        {{ __('Log In') }}
                    </x-links.nav-link>

                    {{-- Sign Up --}}
                    <x-links.nav-link class="hidden lg:block" href="{{ route('register') }}" wire:navigate>
                        {{ __('Sign Up') }}
                    </x-links.nav-link>
                @endguest

                @auth
                    {{-- Notifications --}}
                    {{-- <livewire:notifications.notification-bell /> --}}

                    {{-- Dropdown --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            {{-- Avatar --}}
                            <span class="cursor-pointer">
                                <x-avatar :image="auth()->user()->avatar_path" width="sm" />
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Profile --}}
                            <x-dropdown-button :href="route('profile.show', auth()->user()->username)" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-button>

                            {{-- Settings --}}
                            <x-dropdown-button :href="route('settings')" wire:navigate>
                                {{ __('Settings') }}
                            </x-dropdown-button>

                            {{-- Logout --}}
                            <x-dropdown-button wire:click="logout">
                                {{ __('Logout') }}
                            </x-dropdown-button>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>
