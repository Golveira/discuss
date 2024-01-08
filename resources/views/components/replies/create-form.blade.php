<form class="space-y-3" wire:submit="create">
    <h3 class="font-bold text-gray-900 dark:text-white">Add a Reply</h3>

    <x-editor id="form.body" name="form.body" height="h-32" wire:model="form.body" />

    <div class="text-end">
        <x-buttons.primary type="submit">
            {{ __('Reply') }}
        </x-buttons.primary>
    </div>
</form>
