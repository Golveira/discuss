<x-dropdown align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    @if ($user->isBanned())
        <x-slot name="content">
            <x-dropdown-button wire:click="unban">
                {{ __('Unban') }}
            </x-dropdown-button>
        </x-slot>
    @else
        <x-slot name="content">
            <x-dropdown-button wire:click="ban">
                {{ __('Ban') }}
            </x-dropdown-button>
        </x-slot>
    @endif
</x-dropdown>
