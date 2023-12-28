<x-card class="space-y-4">
    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
        {{ __('Notifications') }}
    </h2>

    @if ($thread->hasSubscriber(auth()->user()))
        <x-buttons.secondary class="flex w-full items-center justify-center gap-1" outline wire:click="unsubscribe">
            <x-icons.bell-slash />
            {{ __('Unsubscribe') }}
        </x-buttons.secondary>

        <p class="text-sm text-gray-400">
            {{ __(" You're receiving notifications from this thread.") }}
        </p>
    @else
        <x-buttons.primary class="flex w-full items-center justify-center gap-1" wire:click="subscribe">
            <x-icons.bell-ring />
            {{ __('Subscribe') }}
        </x-buttons.primary>

        <p class="text-sm text-gray-400">
            {{ __("You're not receiving notifications from this thread.") }}
        </p>
    @endif
</x-card>
