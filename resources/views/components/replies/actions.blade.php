@props(['reply'])

<x-dropdown id="reply-actions" align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    <x-slot name="content">
        <x-dropdown-button @click="$wire.isEditing = true">
            {{ __('Edit') }}
        </x-dropdown-button>

        <x-dropdown-button wire:click="$parent.delete({{ $reply->id }})">
            {{ __('Delete') }}
        </x-dropdown-button>
    </x-slot>
</x-dropdown>
