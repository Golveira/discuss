@props(['name' => '', 'label' => '', 'id' => '', 'placeholder' => '', 'height' => 'h-32'])

<div x-data="{
    mode: 'write',
    content: @entangle($attributes->wire('model')),
    mentionableItems: [],
    selectedItem: null,
    activeItem: null,
    dropdownOpen: false,
    cursorTop: 0,
    cursorLeft: 0,
    init() {
        $watch('mentionableItems', () => {
            this.activeItem = this.mentionableItems[0];
        });
    },
    isPreviewMode() {
        return this.mode === 'preview';
    },
    isWriteMode() {
        return this.mode === 'write';
    },
    openDropdown() {
        this.dropdownOpen = true;
    },
    closeDropdown() {
        this.dropdownOpen = false;
        this.clearMentionableItems();
        this.updateDropdownPosition();
    },
    mentionableItemsEmpty() {
        return this.mentionableItems.length === 0;
    },
    clearMentionableItems() {
        this.mentionableItems = [];
    },
    selectItem(item) {
        this.selectedItem = item;
        this.insertTextAtCursor(item.value);
        this.closeDropdown();
    },
    focusTextarea() {},
    insertTextAtCursor(text) {
        const textBeforeCursor = this.getTextBeforeCursor();
        const textAfterCursor = this.getTextAfterCursor();
        this.content = textBeforeCursor + text + textAfterCursor + ' ';
        this.focusTextarea();
    },
    itemIsActive(item) {
        return this.activeItem && item.key === this.activeItem.key;
    },
    highlightNextItem() {
        let currentIndex = this.mentionableItems.indexOf(this.activeItem);
        let nextIndex = currentIndex >= this.mentionableItems.length - 1 ? 0 : currentIndex + 1;
        this.activeItem = this.mentionableItems[nextIndex];
    },
    highlightPreviousItem() {
        let currentIndex = this.mentionableItems.indexOf(this.activeItem);
        let previousIndex = currentIndex <= 0 ? this.mentionableItems.length - 1 : currentIndex - 1;
        this.activeItem = this.mentionableItems[previousIndex];
    },
    getCursorPosition() {
        return this.$refs.textarea.selectionStart;
    },
    getTextBeforeCursor() {
        return this.$refs.textarea.value.substring(0, this.getCursorPosition());
    },
    getTextAfterCursor() {
        return this.$refs.textarea.value.substring(this.getCursorPosition());
    },
    getSearchTerm(searchTerm) {
        const text = this.getTextBeforeCursor();
        const match = text.match(/@(?!\s)([\w\-.]*)$/);
        return match ? match[1] : null;
    },
    shouldIgnoreKey(key) {
        if (key === 'ArrowUp') return true;
        if (key === 'ArrowDown') return true;
        if (key === 'Escape') return true;
        if (key === 'Tab') return true;
    },
    updateDropdownPosition() {
        const coordinates = getCaretCoordinates(this.$refs.textarea); // global function
        this.cursorTop = coordinates.top + 25 + 'px';
        this.cursorLeft = coordinates.left + 'px';
    },
    searchMentionableItems(event) {
        if (this.shouldIgnoreKey(event.key)) {
            return;
        }
        const searchTerm = this.getSearchTerm();
        this.updateDropdownPosition();
        if (searchTerm !== null) {
            $wire.getMentionableItems(searchTerm);
            this.openDropdown();
        } else {
            this.closeDropdown();
        }
    },
}" x-cloak>
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
                    @click="mode = 'preview'">
                    Preview
                </button>
            </div>
        </div>

        <div class="relative px-4 py-2" x-id="['textarea']">
            <textarea
                class="{{ $height }} block w-full border-0 bg-white px-0 text-sm text-gray-800 focus:ring-0 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400"
                placeholder="{{ $placeholder }}" required x-model="content" x-show="isWriteMode()"
                @keydown.debounce.250="searchMentionableItems" @keydown.escape="closeDropdown" @click.away="closeDropdown"
                @keydown.arrow-up.prevent="highlightPreviousItem" @keydown.arrow-down.prevent="highlightNextItem" x-ref="textarea"></textarea>

            <div class="{{ $height }} prose block max-w-full overflow-y-auto border-0 bg-white px-0 text-sm text-gray-800 dark:prose-invert focus:ring-0 prose-a:text-blue-600 prose-img:rounded-xl dark:bg-gray-900 dark:text-white dark:placeholder-gray-400"
                x-show="isPreviewMode()">
                <div x-text="content"></div>
            </div>

            <ul class="absolute z-10 w-44 rounded-lg bg-white py-2 text-gray-700 shadow dark:bg-gray-800 dark:text-gray-200"
                :style="`top: ${cursorTop}; left: ${cursorLeft}; display: ${mentionableItemsEmpty() ? 'none' : 'block'};`"
                x-show="dropdownOpen && !mentionableItemsEmpty()">
                <template x-for="item in mentionableItems" :key="item.key">
                    <li class="block cursor-pointer px-4 py-2" tabindex="0"
                        :class="itemIsActive(item) ? 'bg-gray-100 dark:bg-gray-700 dark:text-white' : ''"
                        x-text="item.value" @click="selectItem(item)" @mousemove="activeItem = item">
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
