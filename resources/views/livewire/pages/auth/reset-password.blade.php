<div class="flex h-full items-center lg:py-16">
    <div class="mx-auto w-full max-w-md p-6">
        <x-card>
            <h1
                class="mb-6 text-center text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-2xl">
                {{ __('Reset Password') }}
            </h1>

            <form wire:submit="resetPassword">
                {{--  Email --}}
                <div class="mb-6">
                    <x-forms.input id="email" name="email" type="email" label="Email" wire:model="email" required />
                </div>

                {{--  Password --}}
                <div class="mb-6">
                    <x-forms.input id="password" name="password" type="password" label="Password" wire:model="password"
                        required />
                </div>

                {{--  Confirm Password --}}
                <div class="mb-8">
                    <x-forms.input id="password_confirmation" name="password_confirmation" type="password"
                        label="Confirm password" wire:model="password_confirmation" />
                </div>

                <x-buttons.primary class="w-full">
                    {{ __('Update') }}
                </x-buttons.primary>
            </form>
        </x-card>
    </div>
</div>
