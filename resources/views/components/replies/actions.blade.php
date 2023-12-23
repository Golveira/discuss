@props(['reply'])

<x-dropdown align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    <x-slot name="content">
        <x-dropdown-button @click="$wire.editing = true">
            {{ __('Edit') }}
        </x-dropdown-button>

        <x-dropdown-button wire:click="delete">
            {{ __('Delete') }}
        </x-dropdown-button>
    </x-slot>
</x-dropdown>
