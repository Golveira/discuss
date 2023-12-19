<x-list-item :avatar="$discussion->author->username_initial" :value="$discussion->title" link="{{ route('discussions.show', $discussion->slug) }}">
    <x-slot name="subValue">
        <div class="flex items-center gap-2">
            <x-links.secondary href="{{ route('profile.show', $discussion->author->username) }}" wire:navigate>
                {{ $discussion->author->username }}
            </x-links.secondary>

            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ $discussion->created_at_formatted }}
            </span>
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex gap-3">
            <x-likes-count :count="$discussion->likes_count" />
            <x-comments-count :count="$discussion->comments_count" />
        </div>
    </x-slot>
</x-list-item>
