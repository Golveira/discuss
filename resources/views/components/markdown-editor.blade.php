@props([
    'id' => '',
    'name' => '',
    'label' => '',
    'placeholder' => '',
    'height' => 'h-32',
])

<div x-data="{
    mode: 'write',
    content: @entangle($attributes->wire('model')),
    convertedContent: '',
    isPreviewMode() {
        return this.mode === 'preview';
    },
    isWriteMode() {
        return this.mode === 'write';
    },
    convertContent() {
        this.convertedContent = DOMPurify.sanitize(marked.parse(this.content));
    },
    focusTextArea(event) {
        if (event.detail == '{{ $id }}') {
            this.$nextTick(() => {
                document.getElementById('{{ $id }}').focus()
            });
        }
    }
}" @focus-markdown-editor.window="focusTextArea" x-cloak>
    @if ($label)
        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif

    <div @class([
        'group w-full rounded-lg border border-gray-300 bg-white dark:border-gray-600 dark:bg-gray-900',
        '!border-red-500' => $errors->has($name),
    ])>
        <div class="flex items-center justify-between border-b border-gray-300 px-4 py-1 dark:border-gray-600">
            <div class="flex">
                <button class="p-2 text-sm font-bold" type="button"
                    :class="isWriteMode() ? 'text-blue-600 dark:text-white' : 'text-gray-600 dark:text-gray-400'"
                    @click="mode = 'write'">
                    Write
                </button>

                <button class="p-2 text-sm font-bold" type="button"
                    :class="isPreviewMode() ? 'text-blue-600 dark:text-white' : 'text-gray-600 dark:text-gray-400'"
                    @click="mode = 'preview'; convertContent()">
                    Preview
                </button>
            </div>
        </div>

        <div class="relative px-4 py-2">
            <textarea
                class="{{ $height }} block w-full border-0 bg-white px-0 text-sm text-gray-800 focus:ring-0 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400"
                id="{{ $id }}" placeholder="{{ $placeholder }}" required x-model="content" x-show="isWriteMode()"></textarea>

            <div class="{{ $height }} prose block max-w-full overflow-y-auto border-0 bg-white px-0 text-sm text-gray-800 dark:prose-invert focus:ring-0 prose-a:text-blue-600 prose-img:rounded-xl dark:bg-gray-900 dark:text-white dark:placeholder-gray-400"
                x-show="isPreviewMode()">
                <div x-html="convertedContent"></div>
            </div>
        </div>
    </div>
</div>

@pushOnce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/marked@4.0.12/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.6/dist/purify.min.js"></script>
@endpushOnce
