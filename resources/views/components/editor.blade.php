@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'height' => 'h-48',
])

<div x-data="{
    tab: 'write',
    isPreview: false,
    content: @entangle($attributes->wire('model')),
    convertedContent: '',
    handleWrite() {
        this.tab = 'write';
        this.isPreview = false;
    },
    handlePreview() {
        this.tab = 'preview';
        this.isPreview = true;
        this.convertMarkdown();
    },
    convertMarkdown() {
        this.convertedContent = DOMPurify.sanitize(marked.parse(this.content));
    }
}">
    @if ($label)
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif

    <div @class([
        'mb-4 w-full rounded-lg border border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-800 group focus-within:!border-blue-500',
        '!border-red-500' => $errors->has($attributes->get('name')),
    ])>
        <div class="flex items-center justify-between border-b border-gray-300 px-4 py-1 dark:border-gray-600">
            <div class="flex">
                <button class="border-b-2 border-transparent p-2 text-sm font-bold" type="button"
                    :class="tab === 'write' ? 'text-blue-600 dark:text-white' : 'text-gray-600 dark:text-gray-400'"
                    @click="handleWrite">
                    Write
                </button>

                <button class="border-b-2 border-transparent p-2 text-sm font-bold" type="button"
                    :class="tab === 'preview' ? 'text-blue-600 dark:text-white' : 'text-gray-600 dark:text-gray-400'"
                    @click="handlePreview">
                    Preview
                </button>
            </div>
        </div>

        <div class="rounded-b-lg bg-white px-4 py-2 dark:bg-gray-800">
            <textarea
                class="{{ $height }} block w-full border-0 bg-white px-0 text-sm text-gray-800 focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" required x-model="content"
                x-show="!isPreview"></textarea>

            <div class="{{ $height }} prose block max-w-full overflow-y-auto border-0 bg-white px-0 text-sm text-gray-800 dark:prose-invert focus:ring-0 prose-a:text-blue-600 prose-img:rounded-xl dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                x-html="convertedContent" x-show="isPreview">
            </div>
        </div>
    </div>

    @error($name)
        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </div>
    @enderror
</div>

@pushOnce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/marked@4.0.12/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.6/dist/purify.min.js"></script>
@endpushOnce
