@props(['user'])

<x-links.default class="flex items-center gap-3" href="{{ route('profile.show', $user->username) }}">
    <x-avatar :image="$user->avatarFullPath()" width="sm" />
    <span>{{ $user->username }}</span>
</x-links.default>
