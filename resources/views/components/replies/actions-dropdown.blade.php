@props(['reply'])

<x-dropdowns.dropdown id="reply-actions" align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    <x-slot name="content">
        <x-dropdowns.dropdown-button @click="isEditing = true">
            {{ __('Edit') }}
        </x-dropdowns.dropdown-button>

        <x-dropdowns.dropdown-button wire:click="delete">
            {{ __('Delete') }}
        </x-dropdowns.dropdown-button>
    </x-slot>
</x-dropdowns.dropdown>
