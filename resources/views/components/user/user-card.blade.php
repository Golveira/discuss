@props(['user'])

<x-card>
    <div class="flex flex-col items-center gap-3">
        <x-links.secondary class="flex flex-col items-center gap-3" href="{{ route('profile.show', $user->username) }}"
            wire:navigate>
            <x-user-avatar :$user width="lg" />
            <span class="text-lg">{{ $user->username }}</span>
        </x-links.secondary>

        <span class="text-gray-400">
            {{ __('Joined') }} {{ $user->joined_date }}
        </span>
    </div>
</x-card>
