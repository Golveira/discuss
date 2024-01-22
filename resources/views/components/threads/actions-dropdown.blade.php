@props(['thread'])

<div>
    <x-dropdowns.dropdown id="thread-actions" align="right" width="36">
        <x-slot name="trigger">
            <x-buttons.dots />
        </x-slot>

        <x-slot name="content">
            <x-dropdowns.dropdown-button href="{{ route('threads.edit', $thread->id) }}" wire:navigate>
                {{ __('Edit') }}
            </x-dropdowns.dropdown-button>

            <x-dropdowns.dropdown-button @click="$dispatch('open-modal', {{ $thread->id }})">
                {{ __('Delete') }}
            </x-dropdowns.dropdown-button>
        </x-slot>
    </x-dropdowns.dropdown>

    <x-confirm-modal title="Delete discussion?" :id="$thread->id"
        message="The discussion will be deleted permanently. You will not be able to restore the discussion or its comments."
        action="delete" buttonText="Delete discussion" />
</div>
