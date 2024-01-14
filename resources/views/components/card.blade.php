<div
    {{ $attributes->merge(['class' => ' relative p-4 sm:p-6 md:p-8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-900 dark:border-gray-700']) }}>
    @if ($header ?? false)
        <div {{ $header->attributes->class(['mb-6 flex items-center justify-between']) }}>
            {{ $header }}
        </div>
    @endif

    @if ($body ?? false)
        <div class="mb-6 space-y-4">
            {{ $body }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        @if ($footer ?? false)
            <div {{ $footer->attributes->class(['flex items-center gap-3']) }}>
                {{ $footer }}
            </div>
        @endif

        @if ($actions ?? false)
            <div {{ $footer->attributes->class(['flex items-center gap-2']) }}>
                {{ $actions }}
            </div>
        @endif
    </div>

    {{ $slot }}
</div>
