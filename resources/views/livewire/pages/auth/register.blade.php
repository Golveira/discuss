<div class="flex h-full items-center lg:py-16">
    <div class="mx-auto w-full max-w-md p-6">
        <x-card>
            <h1
                class="mb-6 text-center text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                {{ __('Create an account') }}
            </h1>

            <form wire:submit="register">
                {{-- Name --}}
                <div class="mb-6">
                    <x-forms.input id="name" name="name" type="text" label="Name" wire:model="name" required />
                </div>

                {{-- Username --}}
                <div class="mb-6">
                    <x-forms.input id="username" name="username" type="text" label="Username" wire:model="username"
                        required />
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <x-forms.input id="email" name="email" type="email" label="Email" wire:model="email"
                        required />
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <x-forms.input id="password" name="password" type="password" label="Password" wire:model="password"
                        required />
                </div>

                <div class="my-8">
                    <x-buttons.primary class="w-full">
                        {{ __('Create Account') }}
                    </x-buttons.primary>
                </div>

                <p class="text-center text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Already have an account?') }}

                    <x-links.primary href="{{ route('login') }}" wire:navigate>
                        {{ __('Sign in') }}
                    </x-links.primary>
                </p>
            </form>
        </x-card>
    </div>
</div>
