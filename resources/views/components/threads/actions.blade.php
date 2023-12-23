@props(['thread'])

<x-dropdown align="right" width="32">
    <x-slot name="trigger">
        <x-buttons.dots />
    </x-slot>

    <x-slot name="content">
        <x-dropdown-button href="{{ route('threads.edit', $thread->slug) }}" wire:navigate>
            {{ __('Edit') }}
        </x-dropdown-button>

        <x-confirm-modal title="Are you sure you want to delete this thread?">
            <x-slot name="trigger">
                <x-dropdown-button>
                    {{ __('Delete') }}
                </x-dropdown-button>
            </x-slot>

            <x-slot name="actions">
                <x-buttons.danger wire:click="delete">
                    {{ __('Delete') }}
                </x-buttons.danger>

                <x-buttons.secondary>
                    {{ __('Cancel') }}
                </x-buttons.secondary>
            </x-slot>
        </x-confirm-modal>
    </x-slot>
</x-dropdown>
