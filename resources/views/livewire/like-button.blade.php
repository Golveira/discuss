<div x-data="{
    isLiked: $wire.entangle('isLiked'),
}">
    <button class="inline-flex items-center gap-1 rounded-full border"
        :class="{
            'border-blue-600 bg-blue-600 px-2 py-1 text-sm text-white hover:border-blue-700 hover:bg-blue-700': isLiked,
            'border-gray-600 px-2 py-1 text-sm text-gray-500 dark:text-gray-400': !isLiked,
        }"
        wire:click="toggleLike">

        <x-icons.like-solid class="h-5 w-5" x-show="isLiked" />
        <x-icons.like class="h-5 w-5" x-show="!isLiked" />

        <span>{{ $likeable->likes_count }}</span>
    </button>
</div>
