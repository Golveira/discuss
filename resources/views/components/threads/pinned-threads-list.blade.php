@props(['threads'])

@php
    $bgColors = ['bg-gradient-to-l from-blue-400 to-emerald-400', 'bg-gradient-to-r from-rose-400 via-fuchsia-500 to-indigo-500', 'bg-gradient-to-r from-sky-400 to-blue-500', 'bg-gradient-to-r from-orange-400 to-rose-400'];
@endphp

<div class="flex gap-4 overflow-auto">
    @foreach ($threads as $thread)
        <div class="relative w-1/2 flex-shrink-0 rounded-lg border border-gray-300 dark:border-gray-700 lg:flex-1">
            <div class="{{ $bgColors[$loop->index] }} h-8 rounded-t-lg">
            </div>

            <div class="absolute left-4 top-4">
                <x-avatar class="border-2 border-gray-300" :image="$thread->author->avatar_path" width="sm" />
            </div>

            <div class="mb-4 space-y-1 px-4 py-6">
                <h3>
                    <x-links.default class="text-lg" href="{{ route('threads.show', $thread->id) }}">
                        {{ $thread->title }}
                    </x-links.default>
                </h3>

                <div class="flex items-center gap-1">
                    <span>{{ $thread->category->emoji }}</span>

                    <x-links.secondary href="{{ route('categories', $thread->category->slug) }}">
                        {{ $thread->category->name }}
                    </x-links.secondary>

                    <span class="text-white">·</span>

                    <x-links.secondary href="{{ route('profile.show', $thread->author->username) }}">
                        {{ $thread->author->username }}
                    </x-links.secondary>
                </div>
            </div>
        </div>
    @endforeach
</div>
