@php
    $class = "before:relative before:-left-3 before:top-0 before:rounded-lg before:block before:h-6 before:border-l-4 before:border-transparent before:content-[''] flex items-center gap-1 px-1 py-1.5 mb-1 text-gray-900 text-sm rounded-lg hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800";
    $activeClass = 'before:!border-blue-600 bg-gray-200 dark:!bg-gray-800';
@endphp

<div class="space-y-2">
    <div class="dark:text-white font-bold text-gray-900 ">
        Categories
    </div>

    <ul>
        @foreach ($channels as $channel)
            <li>
                <a @class([
                    $class,
                    $activeClass => request()->is("discussions/channels/$channel->slug"),
                ]) href="{{ route('channels', $channel->slug) }}" wire:navigate>
                    <span>{{ $channel->emoji }}</span>
                    <span>{{ $channel->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
