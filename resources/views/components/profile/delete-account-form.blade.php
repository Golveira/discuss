<section class="space-y-6" id="remove-account">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Danger Zone
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Please be aware that deleting your account will also remove all of your data, including your discussions and
            comments. This cannot be undone.
        </p>
    </header>

    <div>
        <x-buttons.danger @click="$dispatch('open-modal', 'modal')">
            Delete Account
        </x-buttons.danger>

        <x-confirm-modal id="modal" title="Delete account"
            message="Are you sure you want to delete your account? All your data will be lost forever."
            action="deleteAccount" buttonText="Delete account" />
    </div>
</section>
