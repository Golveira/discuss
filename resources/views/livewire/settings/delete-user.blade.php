<section class="space-y-6" id="remove-account">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Danger Zone') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Please be aware that deleting your account will also remove all of your data, including your discussions and comments. This cannot be undone.') }}
        </p>
    </header>

    <x-confirm-modal title="Are you sure you want to delete your account?">
        <x-slot name="trigger">
            <x-buttons.danger>
                {{ __('Delete Account') }}
            </x-buttons.danger>
        </x-slot>

        <x-slot name="actions">
            <form wire:submit="deleteUser">
                <div class="flex justify-center gap-3">
                    <x-buttons.danger type="submit">
                        {{ __('Delete') }}
                    </x-buttons.danger>

                    <x-buttons.secondary type="button" @click="modalOpen = false">
                        {{ __('Cancel') }}
                    </x-buttons.secondary>
                </div>
            </form>
        </x-slot>
    </x-confirm-modal>
</section>
