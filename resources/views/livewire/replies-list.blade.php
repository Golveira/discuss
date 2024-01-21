<div class="space-y-8 pb-6">
    <div class="flex items-center gap-1 text-gray-600 dark:text-white">
        <span class="font-bold">
            {{ $commentsCount }} {{ pluralize('comment', $commentsCount) }}
        </span>

        <span class="font-bold">
            {{ $repliesCount }} {{ pluralize('reply', $repliesCount) }}
        </span>
    </div>

    @foreach ($this->replies as $reply)
        <livewire:reply-item :$thread :$reply :key="$reply->id" />
    @endforeach

    {{ $this->replies->links() }}

    <x-replies.create-reply :$thread />
</div>
