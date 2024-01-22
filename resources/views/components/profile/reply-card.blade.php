@props(['reply'])

<div class="rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
    <div class="mx-4 my-3 flex items-center gap-2">
        <x-users.user-avatar :user="$reply->author" />

        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $reply->date_for_humans }}
        </p>
    </div>

    <div class="mx-4 my-3 space-y-3">
        <x-links.default href="{{ route('threads.show', $reply->thread) }}#comment-{{ $reply->id }}">
            {{ $reply->thread->title }}
        </x-links.default>

        @if (!$reply->isParent())
            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                <x-icons.arrow-turn-down-right />
                In reply to {{ $reply->parent->author->username }}
            </div>
        @endif

        <x-html-content>
            {{ $reply->body_excerpt }}
        </x-html-content>

        <x-buttons.border class="h-7 w-12 cursor-default" type="button">
            <x-icons.arrow-up />
            <span>{{ $reply->likes_count }}</span>
        </x-buttons.border>
    </div>
</div>
