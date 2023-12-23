<form x-show="$wire.editing" wire:submit="save" x-cloak>
    <div class="mb-6">
        <x-forms.text-area wire:model="body">
        </x-forms.text-area>
    </div>

    <div class="flex gap-3">
        <x-buttons.primary>
            {{ __('Save') }}
        </x-buttons.primary>

        <x-buttons.secondary type="button" @click="$wire.editing = false">
            {{ __('Cancel') }}
        </x-buttons.secondary>
    </div>
</form>
