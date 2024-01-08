<div
    {{ $attributes->merge(['class' => ' relative p-4 sm:p-6 md:p-8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700']) }}>
    @if ($actions ?? false)
        <div class="absolute right-4 top-4 p-2">
            {{ $actions }}
        </div>
    @endif

    @if ($header ?? false)
        <div class="mb-6 flex items-center gap-3">
            {{ $header }}
        </div>
    @endif

    @if ($body ?? false)
        <div class="mb-6 space-y-4">
            {{ $body }}
        </div>
    @endif

    @if ($footer ?? false)
        <div>
            {{ $footer }}
        </div>
    @endif

    {{ $slot }}
</div>
