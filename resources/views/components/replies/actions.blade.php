@props(['thread', 'reply', 'isBestReply'])

<div class="flex items-center gap-2">
    @can('update', $thread)
        @if ($isBestReply)
            <x-buttons.transparent class="flex items-center gap-1" wire:click="removeBestReply">
                <x-icons.xmark /> {{ __('Remove Best Answer') }}
            </x-buttons.transparent>
        @else
            <x-buttons.transparent class="flex items-center gap-1 opacity-0 transition group-hover:opacity-100"
                wire:click="markAsBestReply">
                <x-icons.check /> {{ __('Mark as Answer') }}
            </x-buttons.transparent>
        @endif
    @endcan

    @can('update', $reply)
        <x-dropdown id="reply-actions" align="right" width="32">
            <x-slot name="trigger">
                <x-buttons.dots />
            </x-slot>

            <x-slot name="content">
                <x-dropdown-button @click="isEditing = true">
                    {{ __('Edit') }}
                </x-dropdown-button>

                <x-dropdown-button wire:click="$parent.delete({{ $reply->id }})">
                    {{ __('Delete') }}
                </x-dropdown-button>
            </x-slot>
        </x-dropdown>
    @endcan
</div>
