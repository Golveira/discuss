@props(['isBestReply'])

@if ($isBestReply)
    <x-buttons.transparent class="flex items-center gap-1" wire:click="removeBestReply">
        <x-icons.xmark /> {{ __('Remove Best Answer') }}
    </x-buttons.transparent>
@else
    <x-buttons.transparent class="flex items-center gap-1" wire:click="markAsBestReply">
        <x-icons.check /> {{ __('Mark as Answer') }}
    </x-buttons.transparent>
@endif
