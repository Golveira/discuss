<div x-data="{
    body: $wire.entangle('body'),
    open: $wire.entangle('open'),
    isPreview: $wire.entangle('isPreview'),
}" x-cloak>
    <div class="fixed bottom-0 z-50 w-[58rem]" x-show="open"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full">
        <form wire:submit.prevent="{{ $action }}">
            <div class="w-full rounded-lg border border-gray-200 bg-gray-50 dark:border-gray-600 dark:bg-gray-800">
                <div class="flex items-center justify-between border-b p-3 dark:border-gray-600">
                    <div class="flex items-center gap-3 text-gray-900 dark:text-white">
                        <x-icons.arrow-left />

                        <span class="font-bold">
                            {{ $action === 'create' ? __('Write a Reply') : __('Update Reply') }}
                        </span>
                    </div>

                    <x-buttons.transparent wire:click="closeEditor">
                        <x-icons.xmark class="h-6 w-6" />
                    </x-buttons.transparent>
                </div>

                <div class="bg-white px-4 py-2 dark:bg-gray-800">
                    <x-tribute :mentionables="$this->getMentionableUsers()" x-show="!isPreview" />

                    <div class="h-48 overflow-y-scroll" x-show="isPreview">
                        <x-content wire:loading.remove>
                            {!! $this->bodyPreview !!}
                        </x-content>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-gray-200 px-3 py-2 dark:border-gray-600">
                    <x-forms.toggle label="Markdown Preview OFF" wire:model.live="isPreview" />

                    <div class="flex gap-4">
                        <x-buttons.secondary type="button" wire:click="closeEditor">
                            {{ __('Cancel') }}
                        </x-buttons.secondary>

                        <x-buttons.primary type="submit">
                            {{ $action === 'create' ? __('Reply') : __('Update') }}
                        </x-buttons.primary>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
