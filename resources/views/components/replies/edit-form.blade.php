<form class="space-y-3" id="edit-form" wire:submit="editReply">
    <x-markdown-editor height="h-32" placeholder="Leave a comment" wire:model="editForm.body" />

    <div class="flex justify-between gap-4 px-4 py-2">
        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
            @error('editForm.body')
                {{ $message }}
            @enderror
        </div>

        <div class="flex gap-3">
            <x-buttons.secondary type="button" @click="isEditing = false">
                Cancel
            </x-buttons.secondary>

            <x-buttons.primary type="submit">
                Update
            </x-buttons.primary>
        </div>
    </div>
</form>
