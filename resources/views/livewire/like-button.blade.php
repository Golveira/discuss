<div>
    @php($activeClass = '!border-blue-600 !bg-blue-100 !text-blue-600 !hover:border-blue-700 dark:!border-blue-500 dark:!text-blue-500 hover:!bg-blue-200 dark:!bg-gray-800')

    @auth
        <x-buttons.border @class(['h-7 w-12', $activeClass => $isLiked]) wire:click="toggleLike">
            <x-icons.arrow-up class="h-4 w-4" />
            <span>{{ $likeable->likes_count }}</span>
        </x-buttons.border>
    @else
        <x-buttons.border class="h-7 w-12 cursor-default">
            <x-icons.arrow-up />
            <span>{{ $likeable->likes_count }}</span>
        </x-buttons.border>
    @endauth
</div>
