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
                    <x-links.nav-link href="{{ route('login') }}">
                        {{ __('Log In') }}
                    </x-links.nav-link>

                    {{-- Sign Up --}}
                    <x-links.nav-link class="hidden lg:block" href="{{ route('register') }}">
                        {{ __('Sign Up') }}
                    </x-links.nav-link>
                @endguest

                @auth
                    {{-- Notifications --}}
                    {{-- <livewire:notifications.notification-bell /> --}}

                    {{-- Dropdown --}}
                    <x-dropdowns.dropdown align="right" width="32">
                        <x-slot name="trigger">
                            {{-- Avatar --}}
                            <span class="cursor-pointer">
                                <x-avatar :image="auth()
                                    ->user()
                                    ->avatarFullPath()" width="sm" />
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Profile --}}
                            <x-dropdowns.dropdown-button :href="route('profile.show', auth()->user()->username)" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdowns.dropdown-button>

                            {{-- Settings --}}
                            <x-dropdowns.dropdown-button :href="route('settings.index')" wire:navigate>
                                {{ __('Settings') }}
                            </x-dropdowns.dropdown-button>

                            {{-- Logout --}}
                            <x-dropdowns.dropdown-button wire:click="logout">
                                {{ __('Logout') }}
                            </x-dropdowns.dropdown-button>
                        </x-slot>
                    </x-dropdowns.dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>
