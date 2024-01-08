@props(['mentionables' => []])

<div x-data
    x-init='() => {
        let tribute = new Tribute({
            trigger: "@",
            values: @json($mentionables),
            menuItemLimit: 5,
        });
        tribute.attach($refs.textarea);
    }'
    wire:ignore>
    <textarea
        {{ $attributes->merge(['class' => 'block w-full border-0 h-48 bg-white px-0 text-gray-800 focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400']) }}
        required x-model="body" x-ref="textarea"></textarea>
</div>

@once
    @push('styles')
        <link href="{{ asset('vendor/tribute/tribute.css') }}" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="{{ asset('vendor/tribute/tribute.min.js') }}"></script>
    @endpush
@endonce
