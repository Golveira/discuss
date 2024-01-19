@props(['user'])

<x-links.secondary class="flex items-center gap-3" href="{{ route('profile.show', $user->username) }}" wire:navigate>
    <x-avatar :image="$user->avatar_path" width="sm" />
    <span>{{ $user->username }}</span>
</x-links.secondary>
