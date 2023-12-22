@props(['thread'])

<div class="flex gap-3 border-b border-gray-200 p-4 last:border-b-0 dark:border-gray-700">
    <x-avatar :image="$thread->author->avatar_path" :placeholder="$thread->author->username_initials" />

    <div class="flex flex-1 flex-col justify-between gap-4 lg:flex-row lg:items-center">
        <div class="font-medium dark:text-white">
            <a class="font-medium text-gray-900 hover:underline dark:text-white" href="{{ $thread->slug }}" wire:navigate>
                {{ $thread->title }}
            </a>

            <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <x-links.secondary class="underline" href="#" :value="$thread->author->username" wire:navigate />

                <span>
                    {{ __('asked') }} {{ $thread->date_for_humans }} {{ __('in') }}
                </span>

                <x-links.secondary class="underline" :href="$thread->channel->path" :value="$thread->channel->name" wire:navigate />
            </div>
        </div>

        <div class="flex gap-3">
            <x-likes-count :count="$thread->likes_count" />
            <x-comments-count :count="$thread->replies_count" />
        </div>
    </div>
</div>
