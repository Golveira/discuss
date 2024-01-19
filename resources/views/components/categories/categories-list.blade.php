@php
    $class = "before:relative before:-left-3 before:top-0 before:rounded-lg before:block before:h-6 before:border-l-4 before:border-transparent before:content-[''] flex items-center gap-1 px-1 py-1.5 mb-1 text-gray-900 text-sm rounded-lg hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800";
    $activeClass = 'before:!border-blue-600 bg-gray-200 dark:!bg-gray-800';
@endphp

<div class="space-y-2">
    <div class="font-bold text-gray-900 dark:text-white">
        Categories
    </div>

    <ul>
        <li>
            <a href="{{ route('threads.index') }}" @class([$class, $activeClass => request()->is('discussions')]) wire:navigate>
                <span>#️⃣</span>
                <span>View All Discussions</span>
            </a>
        </li>

        @foreach ($categories as $category)
            <li>
                <a href="{{ route('categories', $category->slug) }}" @class([
                    $class,
                    $activeClass => request()->is("discussions/categories/$category->slug"),
                ]) wire:navigate>
                    <span>{{ $category->emoji }}</span>
                    <span>{{ $category->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
