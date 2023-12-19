@props(['count', 'isLiked' => false])

<button
    class="{{ $isLiked
        ? 'border-blue-600 bg-blue-600 px-2 py-1 text-sm text-white hover:border-blue-700 hover:bg-blue-700'
        : 'border-gray-600 px-2 py-1 text-sm text-gray-500 dark:text-gray-400' }} inline-flex items-center gap-1 rounded-full border"
    {{ $attributes }}>

    @if ($isLiked)
        <x-icons.like-solid class="h-5 w-5" wire:key="like-solid" />
    @else
        <x-icons.like class="h-5 w-5" wire:key="like" />
    @endif

    @if (isset($count))
        <span>{{ $count }}</span>
    @endif
</button>
