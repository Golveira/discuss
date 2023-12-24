<x-card {{ $attributes->merge(['class' => 'relative mb-8']) }}>
    <div class="absolute right-5">
        {{ $actions }}
    </div>

    <div class="mb-6 flex items-center gap-3">
        {{ $header }}
    </div>

    <div class="mb-6">
        {{ $body }}
    </div>

    {{ $footer }}
</x-card>
