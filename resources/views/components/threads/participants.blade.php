@props(['participants'])

<div class="space-y-2 border-b border-gray-300 pb-4 dark:border-gray-700">
    <div class="text-sm text-gray-600 dark:text-gray-400">
        {{ $participants->count() }} Participants
    </div>

    <div class="flex flex-wrap items-center gap-2">
        @foreach ($participants as $participant)
            <x-tooltip value="{{ $participant->username }}">
                <a href="{{ route('profile.show', $participant->username) }}" wire:navigate>
                    <x-avatar :image="$participant->avatar_path" width="xs" />
                </a>
            </x-tooltip>
        @endforeach
    </div>
</div>
