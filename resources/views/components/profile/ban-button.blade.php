<div>
    @if ($user->isBanned())
        <x-buttons.secondary class="w-full" wire:click="unban">
            Unban
        </x-buttons.secondary>
    @else
        <x-buttons.secondary class="w-full" wire:click="ban">
            Ban
        </x-buttons.secondary>
    @endif
</div>
