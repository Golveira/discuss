<x-list-item :avatar="$comment->discussion->author->username_initial" :value="$comment->discussion->title" link="{{ route('discussions.show', $comment->discussion->slug) }}">
    <x-slot name="subValue">
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ $comment->created_at_formatted }}
            </span>

            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ $comment->body_excerpt }}
            </span>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex gap-3">
            <x-likes-count :count="$comment->likes_count" />
        </div>
    </x-slot>
</x-list-item>
