@props(['thread'])

<x-dropdown align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    <x-slot name="content">
        <x-dropdown-button href="#" wire:navigate>
            {{ __('Edit') }}
        </x-dropdown-button>

        {{-- <livewire:discussion.delete :discussion="$discussion" /> --}}
    </x-slot>
</x-dropdown>
