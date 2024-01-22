<section id="password">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Update the password used for logging into your account.
        </p>
    </header>

    <form class="mt-6 space-y-6" wire:submit="updatePassword">
        {{-- Current password --}}
        <div>
            <x-forms.input id="passwordForm.current_password" name="passwordForm.current_password" type="password"
                label="Current Password" wire:model="passwordForm.current_password" />
        </div>

        {{-- New password --}}
        <div>
            <x-forms.input id="passwordForm.password" name="passwordForm.password" type="password" label="New Password"
                wire:model="passwordForm.password" />
        </div>

        {{-- Confirm new password --}}
        <div>
            <x-forms.input id="passwordForm.password_confirmation" name="passwordForm.password_confirmation"
                type="password" label="Confirm new password" wire:model="passwordForm.password_confirmation" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary>
                Update password
            </x-buttons.primary>
        </div>
    </form>
</section>
