@auth
    <div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Notifications
        </div>

        <div class="flex flex-col items-center gap-2">
            @if ($thread->hasSubscriber(auth()->user()))
                <x-buttons.subscribe wire:click="unsubscribe">
                    <x-icons.bell-slash />
                    Unsubscribe
                </x-buttons.subscribe>

                <p class="text-xs text-gray-600 dark:text-gray-400">
                    You're receiving notifications because you're subscribed to this thread.
                </p>
            @else
                <x-buttons.subscribe wire:click="subscribe">
                    <x-icons.bell />
                    Subscribe
                </x-buttons.subscribe>

                <p class="text-xs text-gray-600 dark:text-gray-400">
                    You're not receiving notifications from this thread.
                </p>
            @endif
        </div>
    </div>
@endauth
