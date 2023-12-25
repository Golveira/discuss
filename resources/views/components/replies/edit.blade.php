<form x-show="$wire.isEditing" wire:submit="update" x-cloak>
    <div class="mb-6">
        <x-forms.text-area wire:model="form.body" />
    </div>

    <div class="flex gap-3">
        <x-buttons.primary>
            {{ __('Save') }}
        </x-buttons.primary>

        <x-buttons.secondary type="button" @click="$wire.isEditing = false">
            {{ __('Cancel') }}
        </x-buttons.secondary>
    </div>
</form>
