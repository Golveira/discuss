<form class="mb-8 space-y-3" wire:submit="create">
    <div class="mb-4 w-full rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-700">
        <div class="rounded-t-lg bg-white px-4 py-2 dark:bg-gray-800">
            <x-forms.text-area class="w-full border-0 bg-white px-0 text-sm focus:ring-0 dark:bg-gray-800" id="form.body"
                name="form.body" rows="4" placeholder="Write a Reply" wire:model="form.body" />
        </div>

        <div class="flex items-center justify-end border-t px-3 py-2 dark:border-gray-600">
            <x-buttons.primary>
                {{ __('Reply') }}
            </x-buttons.primary>
        </div>
    </div>
</form>
