@props(['category', 'hasDescription' => false, 'hasLink' => false])

<div>
    @if ($hasLink)
        <div class="flex items-center gap-2">
            <span class="rounded-lg bg-gray-300 p-1 dark:bg-gray-700">
                {{ $category->emoji }}
            </span>

            <a class="text-sm text-gray-600 hover:text-blue-700 dark:text-gray-100 dark:hover:text-blue-500"
                href="{{ route('categories', $category->slug) }}" wire:navigate>
                {{ $category->name }}
            </a>
        </div>
    @else
        <div class="font-bold text-gray-900 dark:text-white">
            {{ $category->emoji }} {{ $category->name }}
        </div>
    @endif

    @if ($hasDescription)
        <span class="text-sm text-gray-600 dark:text-gray-400">
            {{ $category->description }}
        </span>
    @endif
</div>
