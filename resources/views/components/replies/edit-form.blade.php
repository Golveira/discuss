<form class="space-y-3" wire:submit="update">
    <livewire:markdown-editor cancelAction="" wire:model="form.body" />

    <div class="flex justify-end gap-4">
        <x-buttons.secondary type="button" @click="isEditing = false">
            {{ __('Cancel') }}
        </x-buttons.secondary>

        <x-buttons.primary type="submit">
            {{ __('Save') }}
        </x-buttons.primary>
    </div>
</form>
