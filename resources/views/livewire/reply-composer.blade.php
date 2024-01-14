<div class="fixed bottom-0 z-50 w-[58rem]" x-data="{
    isOpen: $wire.entangle('isOpen'),
}" x-show="isOpen"
    x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 translate-y-full"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100 transform"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full" x-cloak>
    <div @class([
        'rounded-lg border border-gray-300 bg-gray-50 dark:border-gray-700 dark:bg-gray-900',
        '!border-red-600' => $errors->has('body'),
    ])>
        <form wire:submit="create">
            <livewire:markdown-editor :hasBorder="false" wire:model="body" />

            <div class="flex justify-between gap-4 border-t border-gray-300 px-4 py-2 dark:border-gray-600">
                <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                    @error('body')
                        {{ $message }}
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-buttons.secondary type="button" wire:click="close">
                        {{ __('Cancel') }}
                    </x-buttons.secondary>

                    <x-buttons.primary type="submit">
                        {{ __('Reply') }}
                    </x-buttons.primary>
                </div>
            </div>
        </form>
    </div>
</div>
