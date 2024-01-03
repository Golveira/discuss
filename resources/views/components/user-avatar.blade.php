@props(['user' => '', 'width' => 'md'])

@if ($user->avatar_path)
    <x-avatar image='{{ asset("storage/{$user->avatar_path}") }}' :width="$width" />
@else
    <x-avatar-placeholder :value="$user->username_initials" :width="$width" />
@endif
