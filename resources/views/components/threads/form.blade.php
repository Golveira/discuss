@props(['title', 'back'])

<div class="space-y-4">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
        {{ $title }}
    </h2>

    {{-- Selected category --}}


    <form class="space-y-8" wire:submit="save">
        {{-- Title --}}
        <div>
            <x-forms.input id="form.title" name="form.title" type="text" label="Add a title" wire:model="form.title"
                required />
        </div>

        {{-- Body --}}
        <div>
            <x-markdown-editor title="Write" label="Add a body" height="h-64" wire:model="form.body" />
        </div>

        <div class="flex justify-end gap-4">
            <x-buttons.secondary href="{{ $back }}" wire:navigate>
                {{ __('Cancel') }}
            </x-buttons.secondary>

            <x-buttons.primary type="submit">
                {{ __('Save') }}
            </x-buttons.primary>
        </div>
    </form>
</div>
