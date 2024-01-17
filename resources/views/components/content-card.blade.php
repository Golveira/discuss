<div class="rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
    <div class="mx-4 my-3 flex items-center justify-between">
        <div {{ $header->attributes->class(['']) }}>
            {{ $header }}
        </div>

        <div {{ $actions->attributes->class(['']) }}>
            {{ $actions }}
        </div>
    </div>

    <div {{ $body->attributes->class(['mx-4 my-3']) }}>
        {{ $body }}
    </div>

    <div>
        {{ $footer }}
    </div>
</div>
