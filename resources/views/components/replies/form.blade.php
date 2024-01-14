@props(['reply', 'action', 'buttonText' => 'Save'])

<div @class([
    'rounded-lg border border-gray-300 bg-gray-50 dark:border-gray-700 dark:bg-gray-900',
    '!border-red-600' => $errors->has('form.body'),
])>
    <form wire:submit="{{ $action }}">
        <livewire:markdown-editor :hasBorder="false" wire:model="form.body" wire:key="reply-editor-{{ $reply->id }}" />

        <div class="flex justify-between gap-4 border-t border-gray-300 px-4 py-2 dark:border-gray-600">
            <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                @error('body')
                    {{ $message }}
                @enderror
            </div>

            <div class="flex gap-3">
                <x-buttons.secondary type="button" @click="isEditing = false">
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary type="submit">
                    {{ __($buttonText) }}
                </x-buttons.primary>
            </div>
        </div>
    </form>
</div>
