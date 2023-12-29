@props(['user' => '', 'width' => 'md'])

<x-avatar :image="$user->avatar_path" :placeholder="$user->username_initials" :width="$width" />
