@props(['reply'])

<div @class(['!border-red-600' => $errors->has('editReplyBody')])>
    <form class="space-y-3" wire:submit="update">
        <livewire:markdown-editor height="h-32" wire:model="editReplyBody" wire:key="editor-{{ $reply->id }}" />

        <div class="flex justify-between gap-4 px-4 py-2">
            <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                @error('editReplyBody')
                    {{ $message }}
                @enderror
            </div>

            <div class="flex gap-3">
                <x-buttons.secondary type="button" @click="isEditing = false">
                    Cancel
                </x-buttons.secondary>

                <x-buttons.primary type="submit">
                    Update reply
                </x-buttons.primary>
            </div>
        </div>
    </form>
</div>
