@auth
    <div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Notifications
        </div>

        <div class="flex flex-col items-center gap-2">
            @if ($thread->hasSubscriber(auth()->user()))
                <button
                    class="flex w-full items-center justify-center gap-1 rounded-lg border border-gray-300 p-2 text-sm text-gray-600 hover:border-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600">
                    <x-icons.bell />
                    Unsubscribe
                </button>

                <p class="text-xs text-gray-600 dark:text-gray-400">
                    You're receiving notifications because you're subscribed to this thread.
                </p>
            @else
                <button
                    class="flex w-full items-center justify-center gap-1 rounded-lg border border-gray-300 p-2 text-sm text-gray-600 hover:border-gray-400 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:border-gray-600">
                    <x-icons.bell />
                    Subscribe
                </button>

                <p class="text-xs text-gray-600 dark:text-gray-400">
                    You're not receiving notifications from this thread.
                </p>
            @endif
        </div>
    </div>
@endauth
