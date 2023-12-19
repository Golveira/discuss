<section id="password">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update the password used for logging into your account.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" wire:submit="updatePassword">
        <div>
            <x-forms.input id="current_password" name="current_password" type="password" :label="__('Current Password')"
                wire:model="current_password" />
        </div>

        <div>
            <x-forms.input id="password" name="password" type="password" :label="__('New Password')" wire:model="password" />
        </div>

        <div>
            <x-forms.input id="password_confirmation" name="password_confirmation" type="password" :label="__('Confirm Password')"
                wire:model="password_confirmation" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary>
                {{ __('Save') }}
            </x-buttons.primary>
        </div>
    </form>
</section>
