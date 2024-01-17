<div class="flex items-start gap-1">
    <div class="mr-3 flex flex-shrink-0 items-center gap-2">
        <x-avatar :image="$reply->author->avatar_path" width="xs" />
    </div>

    <div class="space-y-3">
        <div class="flex items-center justify-between gap-1">
            <div class="flex items-center gap-1">
                <x-links.secondary class="flex items-center gap-3"
                    href="{{ route('profile.show', $reply->author->username) }}" wire:navigate>
                    <span>{{ $reply->author->username }}</span>
                </x-links.secondary>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $reply->date_for_humans }}
                </p>
            </div>

            @can('update', $reply)
                <x-replies.actions :$reply />
            @endcan
        </div>

        <div>
            <x-html-content>
                {{ $reply->body }}
            </x-html-content>
        </div>
    </div>
</div>
