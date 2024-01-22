@props(['reply'])
<div>
    <x-dropdowns.dropdown id="thread-actions" align="right" width="36">
        <x-slot name="trigger">
            <x-buttons.dots />
        </x-slot>

        <x-slot name="content">
            <x-dropdowns.dropdown-button @click="isEditing = true">
                {{ __('Edit') }}
            </x-dropdowns.dropdown-button>

            <x-dropdowns.dropdown-button @click="$dispatch('open-modal', {{ $reply->id }})">
                {{ __('Delete') }}
            </x-dropdowns.dropdown-button>
        </x-slot>
    </x-dropdowns.dropdown>

    <x-confirm-modal title="Delete comment" :id="$reply->id" message="Are you sure you want to delete this comment?"
        action="deleteReply" buttonText="Delete comment" />
</div>
