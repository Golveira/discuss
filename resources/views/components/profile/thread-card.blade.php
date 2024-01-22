@props(['thread'])

<div class="rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
    <div class="mx-4 my-3 flex items-center gap-2">
        <x-users.user-avatar :user="$thread->author" />

        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $thread->date_for_humans }}
        </p>
    </div>

    <div class="mx-4 my-3 space-y-3">
        <h2 class="text-lg">
            <x-links.default href="{{ route('threads.show', $thread) }}">
                {{ $thread->title }}
            </x-links.default>
        </h2>

        <x-html-content>
            {{ $thread->body_excerpt }}
        </x-html-content>

        <x-buttons.border class="h-7 w-12 cursor-default" type="button">
            <x-icons.arrow-up />
            <span>{{ $thread->likes_count }}</span>
        </x-buttons.border>
    </div>
</div>
