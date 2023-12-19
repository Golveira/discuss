<div class="flex h-full items-center py-16">
    <div class="mx-auto w-full max-w-md p-6">
        <x-card>
            <h1
                class="mb-6 text-center text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                {{ __('Sign in to your account') }}
            </h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit="login">
                {{-- Email --}}
                <div class="mb-6">
                    <x-forms.input id="form.email" name="form.email" type="email" label="Email"
                        wire:model="form.email" />
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <x-forms.input id="form.password" name="form.password" type="password" label="Password"
                        wire:model="form.password" />
                </div>

                {{-- Remember me --}}
                <div class="mb-6 flex items-center justify-between">
                    <x-forms.checkbox id="form.remember" name="form.remember" label="Remember me"
                        wire:model="form.remember" />

                    <x-links.primary class="text-sm" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot password') }}
                    </x-links.primary>
                </div>

                <div class="mb-6">
                    <x-buttons.primary class="w-full" type="submit">
                        {{ __('Sign in') }}
                    </x-buttons.primary>
                </div>

                <p class="text-center text-sm font-light text-gray-500 dark:text-gray-400">
                    {{ __('Don\'t have an account yet?') }}

                    <x-links.primary href="{{ route('register') }}" wire:navigate>
                        {{ __('Sign up') }}
                    </x-links.primary>
                </p>
            </form>
        </x-card>
    </div>
</div>
