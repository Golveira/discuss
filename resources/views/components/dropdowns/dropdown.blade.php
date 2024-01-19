@props([
    'align' => 'right',
    'width' => '36',
    'contentClasses' => 'py-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700',
])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
            break;
    }

    switch ($width) {
        case '40':
            $width = 'w-40';
            break;
        case '36':
            $width = 'w-36';
            break;
        case '32':
            $width = 'w-32';
            break;
    }
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false" {{ $attributes }}
    x-cloak>
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div class="{{ $width }} {{ $alignmentClasses }} absolute z-50 mt-2 rounded-md" x-show="open"
        @click="open = false">
        <div class="{{ $contentClasses }} rounded-md ">
            {{ $content }}
        </div>
    </div>
</div>
