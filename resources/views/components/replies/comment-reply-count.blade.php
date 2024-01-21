@props(['comments', 'replies'])

<div class="flex items-center gap-1 text-gray-600 dark:text-white">
    <span class="font-bold">
        {{ $comments }} {{ Str::plural('comment', $comments) }}
    </span>

    <span>·</span>

    <span>
        {{ $replies }} {{ Str::plural('reply', $replies) }}
    </span>
</div>
