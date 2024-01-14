<div x-data="{
    isLiked: $wire.entangle('isLiked'),
}">
    <button class="inline-flex items-center gap-1 rounded-full border px-2 py-1 text-sm"
        :class="{
            'border-blue-600 bg-blue-100  text-blue-600 hover:border-blue-700 dark:border-blue-500 dark:text-blue-500 hover:bg-blue-200 dark:bg-gray-800 transition-all': isLiked,
            'border-gray-600 bg-white text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-700 transition-all':
                !isLiked,
        }"
        wire:click="toggleLike">

        <x-icons.arrow-up class="h-4 w-4" />

        <span>{{ $likeable->likes_count }}</span>
    </button>
</div>
