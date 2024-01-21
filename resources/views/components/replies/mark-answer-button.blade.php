@if ($isAnswer)
    <x-buttons.border wire:click="unmarkAsAnswer">
        Unmark as answer
    </x-buttons.border>
@else
    <x-buttons.border wire:click="markAsAnswer">
        Mark as answer
    </x-buttons.border>
@endif
