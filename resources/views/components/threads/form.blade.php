@props(['category', 'title', 'buttonText', 'back'])

<div class="space-y-5">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        {{ $title }}
    </h2>

    <form class="space-y-8" wire:submit="save">
        {{-- Category --}}
        <div>
            <x-categories.category-select class="w-full" id="form.category_id" name="form.category_id"
                wire:model="form.category_id" />
        </div>

        {{-- Title --}}
        <div>
            <x-forms.input id="form.title" name="form.title" type="text" placeholder="Title" label="Add a title"
                wire:model="form.title" required />
        </div>

        {{-- Body --}}
        <div>
            <x-markdown-editor name="form.body" label="Add a body"
                placeholder="Ask a question, start convesation or make an announcement" height="h-64"
                wire:model="form.body" />
        </div>

        <div class="flex justify-between gap-3">
            <p class="text-sm text-red-600 dark:text-red-400">
                @error('form.body')
                    {{ $message }}
                @enderror
            </p>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4">
                <x-buttons.secondary href="{{ $back }}" wire:navigate>
                    {{ __('Cancel') }}
                </x-buttons.secondary>

                <x-buttons.primary type="submit">
                    {{ $buttonText }}
                </x-buttons.primary>
            </div>
        </div>
    </form>
</div>
