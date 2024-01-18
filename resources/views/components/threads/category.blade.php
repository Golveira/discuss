<div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
    <div class="text-sm text-gray-600 dark:text-gray-400">
        Category
    </div>

    <div class="flex items-center gap-2">
        <span class="rounded-lg bg-gray-300 p-1 dark:bg-gray-700">
            {{ $thread->channel->emoji }}
        </span>

        <a class="text-sm text-gray-600 hover:text-blue-700 dark:text-gray-100 dark:hover:text-blue-500"
            href="{{ route('channels', $thread->channel->slug) }}" wire:navigate>
            {{ $thread->channel->name }}
        </a>
    </div>
</div>
